# Deskripsi Sistem: TokoKita

## 1. Pendahuluan
**TokoKita** adalah sebuah platform aplikasi web *e-commerce* yang dirancang khusus untuk mendukung pelaku Usaha Mikro, Kecil, dan Menengah (UMKM). Platform ini memungkinkan pemilik usaha kecil untuk mendigitalkan bisnis mereka dengan membuka toko online, mengelola inventaris, memproses pesanan, dan menerima pembayaran secara terintegrasi. Sistem ini dibangun menggunakan framework **Laravel 10** dan basis data **MySQL**.

## 2. Aktor Sistem
Sistem ini melibatkan tiga jenis pengguna utama (aktor):
1. **Pembeli (Customer)**: Pengguna umum yang mengunjungi platform untuk mencari, melihat, dan membeli produk dari berbagai toko UMKM.
2. **Penjual (Pemilik UMKM)**: Pengguna yang mendaftar untuk membuka toko online, memasarkan produk, dan mengelola operasional tokonya.
3. **Administrator (Superadmin)**: Pengelola platform yang bertugas mengawasi keseluruhan sistem, memvalidasi pendaftaran toko, dan mengelola data master.

## 3. Fitur Utama Sistem

### 3.1. Modul Pembeli (Customer)
*   **Autentikasi & Profil**: Registrasi, login, dan manajemen profil pembeli beserta alamat pengiriman.
*   **Pencarian & Katalog Produk**: Mencari produk berdasarkan nama, kategori, harga, atau toko, serta melihat detail produk (deskripsi, harga, stok, gambar, ulasan).
*   **Keranjang Belanja**: Menambahkan, mengubah jumlah, atau menghapus produk dari keranjang belanja.
*   **Checkout & Ongkos Kirim**: Melakukan proses *checkout* dan kalkulasi otomatis ongkos kirim berdasarkan alamat tujuan pengiriman.
*   **Pembayaran**: Melakukan pembayaran pesanan.
*   **Pelacakan Pesanan**: Memantau status pesanan (menunggu pembayaran, diproses, dikirim, selesai).
*   **Ulasan & Penilaian**: Memberikan rating dan ulasan pada produk yang telah dibeli.

### 3.2. Modul Penjual (Pemilik UMKM)
*   **Manajemen Toko**: Mendaftar dan mengelola profil toko (nama toko, deskripsi, logo, alamat asal pengiriman).
*   **Manajemen Produk**: 
    *   Menambah, mengubah, dan menghapus data produk.
    *   Mengatur kategori, harga, berat, dan stok produk.
    *   Mengunggah gambar produk.
*   **Manajemen Pesanan (Order Management)**:
    *   Menerima notifikasi pesanan baru.
    *   Mengubah status pesanan (konfirmasi pesanan, pesanan diproses, pengiriman pesanan).
    *   Memasukkan nomor resi pengiriman untuk dilacak oleh pembeli.
*   **Laporan & Analitik (Dashboard Penjual)**:
    *   **Laporan Penjualan**: Rekapitulasi pendapatan penjualan, jumlah produk terjual.
    *   **Laporan Produk**: Menampilkan produk terlaris dan informasi stok yang menipis.
    *   **Laporan Pesanan**: Riwayat transaksi dan status penyelesaian pesanan.

### 3.3. Modul Administrator
*   **Dashboard Utama**: Ringkasan data keseluruhan platform (total pengguna, total toko, total transaksi).
*   **Manajemen Pengguna & Toko**: Melihat daftar pengguna, serta menyetujui atau menolak pendaftaran toko baru.
*   **Manajemen Kategori Master**: Mengelola kategori produk global yang dapat digunakan oleh semua penjual.

## 4. Teknologi yang Digunakan
*   **Backend**: PHP (Framework Laravel 10)
*   **Database**: MySQL
*   **Frontend**: HTML, CSS, JavaScript, dan Blade Templating Engine.

## 5. Kebutuhan Non-Fungsional
*   **Keamanan**: Enkripsi sandi (Bcrypt), proteksi terhadap SQL Injection & XSS, serta perlindungan CSRF yang disediakan oleh Laravel.
*   **Responsivitas**: Antarmuka pengguna harus *Mobile-Friendly* atau responsif agar nyaman diakses melalui perangkat seluler maupun desktop.
*   **Aksesibilitas & Kinerja**: Sistem harus mudah digunakan dan memiliki waktu respons yang optimal.
