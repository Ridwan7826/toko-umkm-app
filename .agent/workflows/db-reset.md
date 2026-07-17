# Workflow: Database Reset & Seeding

Workflow ini akan dijalankan kapanpun ada instruksi untuk mengulang *database* dari awal (reset) beserta dengan suntikan data *dummy* (seeding).

## Langkah-langkah Eksekusi

### 1. Migrasi & Seeding
Jalankan perintah berikut di direktori utama aplikasi menggunakan *tool* eksekusi (*run_command*):
```bash
php artisan migrate:fresh --seed
```

### 2. Verifikasi Skema
Setelah proses eksekusi di atas sukses, agen harus memverifikasi bahwa tabel-tabel utama berikut berhasil dibuat tanpa kendala:
- `users`
- `categories`
- `shops`
- `products`
- `category_product`
- `product_variants`
- `carts`
- `orders`
- `order_details`
- `payments`

### 3. Penghitungan Jumlah Rekam Jejak (Record Count)
Gunakan *php artisan tinker* atau eksekusi *script* PHP untuk menghitung `count()` pada setiap tabel. Kemudian berikan laporan ringkas kepada pengguna dengan format contoh sebagai berikut:

**Laporan Hasil Reset Database:**
*   **Users**: ... baris
*   **Categories**: ... baris
*   **Shops**: ... baris
*   **Products**: ... baris
*   **Product Variants**: ... baris
*   **Orders**: ... baris
*   **Order Details**: ... baris
*   **Payments**: ... baris

Laporkan secara komprehensif ke pengguna bahwa data berhasil diregenerasi dan siap digunakan untuk pengujian atau pengembangan laporan (*reporting*).
