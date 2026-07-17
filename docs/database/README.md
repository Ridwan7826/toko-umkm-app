# Penjelasan Relasi Database TokoKita

Dokumen ini menjelaskan rancangan relasi basis data yang dideklarasikan pada fail `erd.dbml`. Rancangan ini mematuhi standar *Laravel Conventions* (nama tabel *snake_case* jamak, kolom `created_at`, `updated_at`, dan *soft deletes* menggunakan `deleted_at`).

## Penjelasan Tabel & Relasi

1. **`users` -> `shops` (One-to-One)**
   - Setiap entitas penjual (`users` dengan peran `penjual`) maksimal hanya bisa memiliki **satu** entitas toko (`shops`). Ini direpresentasikan dengan *Foreign Key* unik `user_id` di tabel `shops`.

2. **`shops` -> `products` (One-to-Many)**
   - Sebuah toko dapat menjual banyak produk.

3. **`categories` -> `category_product` <- `products` (Many-to-Many dengan tabel Pivot `category_product`)**
   - Sebuah produk kini dapat memiliki lebih dari satu kategori (misalnya: "Pakaian Pria" dan "Produk Diskon"). Hal ini mencegah duplikasi data maupun struktur JSON pada kolom master, mematuhi standar 1NF.

4. **`products` -> `product_variants` (One-to-Many)**
   - **Fitur Utama**: Produk di TokoKita tidak memiliki harga atau stok langsung, melainkan diturunkan ke tabel varian. Misalnya produk "Baju Kaus" memiliki varian "Merah - M" dan "Putih - L". Relasi ini menangani kompleksitas inventori dengan *Foreign Key* `product_id`.

5. **`users` -> `carts` <- `product_variants` (Many-to-Many dengan tabel Pivot `carts`)**
   - Pembeli dapat memasukkan banyak varian produk ke keranjang. Tabel `carts` menjadi persimpangan dengan tambahan atribut `quantity`.

6. **`users` -> `orders` (One-to-Many)**
   - Seorang pembeli (`users`) dapat memiliki rekam jejak pesanan yang banyak.
   
7. **`shops` -> `orders` (One-to-Many)**
   - Sebuah toko (`shops`) akan menerima dan memproses banyak pesanan dari berbagai pembeli.

8. **`orders` -> `order_details` <- `product_variants` (Many-to-Many Pivot)**
   - Saat proses *checkout* selesai, data keranjang dikonversi ke detail pesanan. Tabel `order_details` merangkum `quantity` dan `price_per_unit` (harga di-kunci pada saat pembelian agar tidak berubah meski harga master produk nanti naik).

9. **`orders` -> `payments` (One-to-One)**
   - Pesanan diintegrasikan dengan Midtrans. Relasi dibuat 1-to-1 di mana sebuah tagihan pemesanan menghasilkan tepat satu entitas tagihan *Payment* yang memuat `snap_token` dan pencatatan sukses atau tidaknya transaksi.

10. **`users` -> `wishlists` <- `products` (Many-to-Many Pivot)**
    - Pembeli dapat menyimpan banyak produk ke dalam *Wishlist* mereka. Relasi *Many-to-Many* ini diwujudkan dalam tabel `wishlists` dengan dukungan rekam waktu (timestamps) untuk pengurutan berdasarkan tanggal disukai.

11. **`shops` -> `shop_daily_sales` (One-to-Many)**
    - Tabel agregasi data analitik harian. Setiap penjual (`shops`) memiliki rekapan performa penjualan harian (`date`, `gross_revenue`, `completed_orders`, `cancelled_orders`) untuk pelaporan Dasbor (Dashboard) yang cepat tanpa membebani tabel `orders`.

## Soft Deletes (`deleted_at`)
Digunakan pada tabel `users`, `products`, `product_variants`, dan `orders`. Penerapan ini krusial untuk aplikasi e-commerce agar riwayat laporan penjualan *(Sales Report)* tidak rusak (menjadi *null / error referensi*) apabila penjual secara tidak sengaja menghapus data produknya dari etalase di kemudian hari.
