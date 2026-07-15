# Scope Aplikasi & Batasan Masalah: TokoKita

Dokumen ini mendefinisikan batasan (scope) aplikasi yang realistis untuk dikembangkan dalam kurun waktu 1 semester pengerjaan skripsi. Scope ini berfokus pada kedalaman fitur pengelolaan (kompleksitas *backend* dan basis data) serta penyajian pelaporan yang bervariasi sesuai permintaan.

## 1. Fokus dan Batasan Modul Utama

Untuk memastikan proyek dapat diselesaikan dalam 1 semester dengan tingkat kerumitan yang layak untuk standar skripsi, berikut adalah pembatasan modulnya:

### A. Modul Pengelolaan yang Cukup Kompleks (Core Features)
*   **Manajemen Produk dengan Varian**: Sistem tidak hanya menyimpan satu produk dengan satu harga. Produk dapat memiliki *varian* (misalnya: Warna, Ukuran) yang masing-masing variannya memiliki stok, SKU, dan harga yang berbeda. Ini menjamin kompleksitas relasi *database* (One-to-Many).
*   **Siklus Pesanan (Order State Machine)**: Pesanan memiliki alur status yang ketat dengan validasi pada setiap transisi:
    1.  `Menunggu Pembayaran` (Menunggu proses pembayaran).
    2.  `Pembayaran Terverifikasi` (Sistem mengonfirmasi uang masuk).
    3.  `Diproses` (Penjual menyiapkan barang).
    4.  `Dikirim` (Penjual memasukkan nomor resi, terintegrasi dengan pengecekan pengiriman).
    5.  `Selesai` (Dikonfirmasi oleh pembeli atau otomatis oleh sistem).
    6.  `Dibatalkan` (Otomatis jika melewati batas waktu, atau manual oleh penjual jika stok kosong).
*   **Integrasi Pihak Ketiga (API)**:
    *   **Logistik**: Penggunaan API RajaOngkir untuk perhitungan otomatis tarif pengiriman berdasarkan wilayah.
    *   **Pembayaran**: Integrasi Payment Gateway Midtrans (Mode *Sandbox* untuk keperluan skripsi) guna mendemonstrasikan penyelesaian transaksi otomatis.

### B. Batasan / Yang Tidak Masuk Scope (Out of Scope)
*   Tidak membangun sistem *Chat Real-time* bawaan (bisa diakomodasi dengan tombol *Direct to WhatsApp* penjual).
*   Tidak menyertakan fitur algoritma AI / *Machine Learning* untuk rekomendasi produk (pencarian menggunakan query relasional dan *indexing* standar).
*   Aplikasi berfokus pada arsitektur web responsif, tidak melingkupi pembuatan aplikasi *Native Mobile* (Android/iOS).

---

## 2. Rincian 10 Jenis Laporan (Format Beragam)

Sistem akan menyajikan pelaporan yang komprehensif menggunakan berbagai bentuk representasi data, mulai dari grafik, tabel interaktif, fitur ekspor (Excel/PDF), hingga format cetak. Berikut adalah 10 laporan yang akan diimplementasikan:

### Laporan untuk Penjual (Pemilik UMKM)
1.  **Dashboard Ringkasan Performa (Dashboard & Grafik visual)**
    *   **Deskripsi**: Dasbor utama penjual yang menampilkan *Line Chart* tren pendapatan dalam 30 hari terakhir dan *Pie Chart* komposisi status pesanan aktif.
2.  **Laporan Penjualan Keseluruhan (Tabel, Ekspor Excel, Cetak PDF)**
    *   **Deskripsi**: Detail seluruh transaksi penjualan sukses dengan filter rentang tanggal. Berguna untuk rekapitulasi pembukuan toko UMKM.
3.  **Laporan Produk Terlaris (Grafik Bar & Cetak PDF)**
    *   **Deskripsi**: Peringkat 5 teratas produk dengan kuantitas penjualan tertinggi dalam bentuk diagram batang, bisa dicetak (PDF) untuk kebutuhan evaluasi stok prioritas.
4.  **Laporan Stok Produk Menipis (Tabel & Ekspor Excel)**
    *   **Deskripsi**: Menampilkan produk dan varian yang jumlah stoknya berada di bawah batas minimum (misal < 5). Dapat diunduh ke Excel untuk *stock opname* di gudang.
5.  **Laporan Estimasi Pendapatan / Laba (Tabel & Cetak PDF)**
    *   **Deskripsi**: Perhitungan total penjualan bersih per bulan (dikurangi biaya admin platform, ongkir, dsb) sehingga UMKM bisa mengetahui pendapatan riil.
6.  **Laporan Pembatalan Pesanan (Tabel & Ekspor Excel)**
    *   **Deskripsi**: Rekapitulasi order yang gagal atau dibatalkan beserta alasannya (kadaluwarsa / ditolak penjual). Excel mempermudah analisis operasional mana yang harus diperbaiki.
7.  **Laporan Pelanggan Loyal / *Top Spender* (Tabel & Cetak PDF)**
    *   **Deskripsi**: Menampilkan urutan pembeli berdasarkan frekuensi order dan total belanja tertinggi untuk strategi diskon khusus (*loyalty reward*).
8.  **Invoice / Bukti Transaksi (Format Cetak / PDF)**
    *   **Deskripsi**: Format standar struk pembayaran dan detail pengiriman untuk setiap pesanan. Wajib bisa langsung diprint penjual sebagai label paket, serta diunduh pembeli sebagai resi.

### Laporan untuk Administrator Platform
9.  **Laporan Rekapitulasi Transaksi Platform (Dashboard & Ekspor Excel)**
    *   **Deskripsi**: Admin dapat melihat total *Gross Merchandise Value* (GMV) perputaran uang dari seluruh transaksi UMKM dalam satu periode tertentu.
10. **Laporan Pertumbuhan Toko Baru (Dashboard / Grafik Area)**
    *   **Deskripsi**: Visualisasi tren bulanan mengenai pendaftaran toko UMKM baru di platform untuk menilai seberapa luas jangkauan adopsi aplikasi ini.
