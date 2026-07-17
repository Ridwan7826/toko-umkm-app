---
name: Laravel Migration Builder
description: Memandu agen dalam merancang dan membuat file migration Laravel 10 secara konsisten dengan struktur ERD TokoKita.
---

# Instruksi Skill: Pembuatan Migration Laravel 10

Skill ini digunakan untuk mengarahkan Anda (Agen AI) setiap kali diminta membuat struktur tabel (migrations) di proyek **Laravel 10** agar selaras dengan dokumen `docs/database/erd.dbml`.

## Panduan Utama Penulisan

1. **Urutan Pembuatan Tabel**:
   - Selalu buat tabel independen terlebih dahulu (`users`, `categories`) sebelum membuat tabel dependen (`shops`, `products`).
   - Eksekusi pembuatan *migration* secara berurutan menyesuaikan hirarki Foreign Keys (FK).

2. **Konvensi Tipe Data MySQL di Laravel**:
   - **Primary Key**: Gunakan `$table->id();` (menghasilkan *bigint unsigned auto_increment*).
   - **Foreign Key**: Gunakan `$table->foreignId('column_name')->constrained();`. Jika nama tabel tidak dapat diinferensi secara otomatis, rujuk dengan eksplisit: `->constrained('target_table')`.
   - **Mata Uang (Uang)**: Gunakan presisi dan skala yang tepat untuk e-commerce: `$table->decimal('price', 12, 2);`.
   - **Status/Enum**: Gunakan `$table->enum('status', ['value1', 'value2'])->default('value1');`.
   - **Teks Pendek vs Panjang**: Gunakan `$table->string()` untuk teks seukuran baris (255 chars), dan `$table->text()` untuk deksripsi panjang.

3. **Integritas & Indexing**:
   - Tetapkan constraint `onDelete`. Untuk riwayat transaksi (orders, detail, dsb), gunakan `->onDelete('restrict')` agar data master tidak bisa terhapus jika masih dipakai di transaksi. Untuk tabel pivot biasa, gunakan `->cascadeOnDelete()`.
   - Tambahkan `$table->index('column_name')` pada kolom yang berpotensi besar sering dijadikan filter query (seperti ID Kategori, Status Order).

4. **Timestamps & Soft Deletes**:
   - Wajib melampirkan `$table->timestamps();` pada semua tabel utama (selain pivot standar).
   - Wajib memanggil `$table->softDeletes();` pada entitas utama (`users`, `products`, `orders`) untuk mencegah kehilangan riwayat dan yatim data (*orphaned data*).

---

## Pola Referensi (Code Patterns)

### 1. Pola Tabel Transaksi Utama (Contoh: `orders`)
Tabel transaksi butuh soft-deletes, indexing status, dan ketelitian decimal harga.
```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
    $table->foreignId('shop_id')->constrained('shops')->onDelete('restrict');
    $table->string('invoice_number')->unique();
    $table->decimal('total_product_price', 12, 2);
    $table->decimal('shipping_cost', 12, 2);
    $table->string('courier_name')->nullable();
    $table->string('tracking_number')->nullable();
    $table->enum('status', ['menunggu_pembayaran', 'dibayar', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu_pembayaran');
    $table->timestamps();
    $table->softDeletes();
    
    // Indexing untuk optimasi filter laporan/dasbor
    $table->index('status');
});
```

### 2. Pola Tabel Pivot / Many-to-Many (Contoh: `category_product`)
Tabel pivot tidak membutuhkan `id()` utama maupun `timestamps()`. Wajib menggunakan Composite Primary Key untuk mencegah redudansi relasi.
```php
Schema::create('category_product', function (Blueprint $table) {
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->foreignId('product_id')->constrained()->cascadeOnDelete();
    
    // Composite Primary Key mencegah data ganda
    $table->primary(['category_id', 'product_id']);
});
```

### 3. Pola Tabel Transaksi Detail & Index Komposit (Contoh: `order_details`)
Harga saat transaksi dimasukkan ke keranjang harus dikunci (`price_per_unit`), dan *foreign key*-nya dilindungi oleh constraint tipe restrict.
```php
Schema::create('order_details', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
    $table->foreignId('variant_id')->constrained('product_variants')->onDelete('restrict');
    $table->integer('quantity');
    $table->decimal('price_per_unit', 12, 2);
    $table->timestamps();
    
    // Composite Index untuk percepatan kalkulasi agregat pesanan per varian
    $table->index(['order_id', 'variant_id']);
});
```
