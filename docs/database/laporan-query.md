# Analisis Kebutuhan Query Laporan TokoKita

Dokumen ini merangkum bentuk *query* yang dibutuhkan oleh sistem untuk melayani 10 Laporan, identifikasi *bottleneck* (leher angsa) performa, serta rekomendasi penyesuaian struktur *database*.

## A. Analisis per Laporan

### Modul Penjual
1. **Rep1 (Dasbor Performa)**: Agregasi jumlah pesanan dan total pendapatan per hari selama 30 hari terakhir.
   - *Query*: `SUM(total_product_price)`, `COUNT(*)` berdasarkan `DATE(created_at)`.
   - *Bottleneck*: Memaksa *database* melakukan *Group By* harian ke tabel `orders` yang bervolume besar dapat memberatkan server.
2. **Rep2 (Laporan Penjualan) & Rep5 (Estimasi Pendapatan)**: Rekap rentang waktu tertentu.
   - *Query*: Filter `shop_id`, `status='selesai'`, dan `created_at BETWEEN start AND end`.
3. **Rep3 (Produk Terlaris)**: Top rank produk berdasarkan quantity terjual.
   - *Query*: `JOIN` antara `orders`, `order_details`, `product_variants`, dan `products`. `SUM(quantity)` dikelompokkan berdasarkan `product_id`.
   - *Bottleneck*: Terlalu banyak *Join* tabel pada transaksi *real-time*.
4. **Rep4 (Stok Menipis)**:
   - *Query*: `SELECT * FROM product_variants WHERE stock < 5`.
5. **Rep6 (Pembatalan Pesanan)**:
   - *Query*: Filter `orders` berdasarkan `status='dibatalkan'`.
6. **Rep7 (Top Spender / Pelanggan Loyal)**:
   - *Query*: `SUM(total_product_price)` di `orders` di-group berdasarkan `user_id`.
7. **Rep8 (Cetak Invoice)**:
   - *Query*: `SELECT` by `invoice_number`. (Sudah teratasi, kolom unik).

### Modul Administrator
8. **Rep9 (GMV Platform)**:
   - *Query*: `SUM` seluruh transaksi `orders` berstatus selesai pada keseluruhan platform.
9. **Rep10 (Pertumbuhan Toko)**:
   - *Query*: `COUNT(id)` di tabel `shops` dikelompokkan berdasarkan bulan `created_at`.

---

## B. Solusi Optimasi: Tabel Summary & Index Tambahan

### 1. Tabel Summary (Data Mart)
Untuk mengatasi *bottleneck* Dasbor dan rekapitulasi data jangka panjang (Rep1, Rep2, Rep5, Rep9), kita butuh merancang tabel agregasi **`shop_daily_sales`** yang akan menyimpan rekap total penjualan per hari setiap toko.
*   **Kolom**: `shop_id`, `date`, `total_revenue`, `completed_orders`, `cancelled_orders`.

### 2. Penambahan Index Spesifik
Tabel-tabel transaksional perlu ditambah *index* spesifik:
*   `orders`: Index `(shop_id, status, created_at)` -> Percepat filter dashboard dan rentang waktu.
*   `orders`: Index `(user_id, status)` -> Percepat pencarian rekam jejak loyalitas pelanggan.
*   `product_variants`: Index `(stock)` -> Percepat pencarian sisa stok.
*   `shops`: Index `(created_at)` -> Percepat analisis pertumbuhan toko oleh admin.
