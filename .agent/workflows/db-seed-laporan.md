# Workflow: Seeding Tabel Laporan (shop_daily_sales)

Workflow ini bertujuan untuk menyinkronkan data *historical* dari tabel transaksional (`orders`) dan merangkumnya (agregasi *Group By*) ke dalam tabel analitik `shop_daily_sales`. 

Tabel ini sangat krusial agar halaman **Dasbor Penjual** bisa memuat data dalam satuan milidetik tanpa membebani tabel `orders`.

## Eksekusi Query Agregasi
Alih-alih menggunakan PHP yang mungkin butuh waktu lama (*memory limit*), kita dapat memanfaatkan kecepatan murni dari *engine* MySQL untuk melakukan penyisipan agregat massal (*bulk aggregation insert*).

Jalankan skrip *bash* berikut ini pada terminal `run_command` untuk menyuntikkan data:

```bash
mysql -u root toko_kita -e "
INSERT INTO shop_daily_sales (shop_id, date, total_orders, gross_revenue, completed_orders, cancelled_orders, created_at, updated_at)
SELECT 
    shop_id, 
    DATE(created_at) as date,
    COUNT(id) as total_orders,
    SUM(CASE WHEN status = 'selesai' THEN total_product_price ELSE 0 END) as gross_revenue,
    SUM(CASE WHEN status = 'selesai' THEN 1 ELSE 0 END) as completed_orders,
    SUM(CASE WHEN status = 'dibatalkan' THEN 1 ELSE 0 END) as cancelled_orders,
    NOW(), 
    NOW()
FROM orders
GROUP BY shop_id, DATE(created_at)
ON DUPLICATE KEY UPDATE 
    total_orders = VALUES(total_orders),
    gross_revenue = VALUES(gross_revenue),
    completed_orders = VALUES(completed_orders),
    cancelled_orders = VALUES(cancelled_orders),
    updated_at = NOW();
"
```

## Langkah Verifikasi
Setelah di eksekusi, selalu lakukan verifikasi dengan memastikan bahwa setidaknya puluhan baris unik `shop_id` vs `date` tercipta:
```bash
mysql -u root toko_kita -e "SELECT COUNT(*) as total_rekap_harian FROM shop_daily_sales;"
```
Jika hasilnya `total_rekap_harian` > 0, maka proses *backfill* data laporan kita berhasil.
