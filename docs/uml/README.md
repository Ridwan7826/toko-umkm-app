# Daftar UML Diagram TokoKita

Berikut adalah daftar keseluruhan diagram UML yang telah dibuat berdasarkan ruang lingkup aplikasi.

## Class Diagram
- `class-diagram.puml` : Sintesis arsitektur database/sistem (User, Shop, Product, Variant, Order, Payment) lengkap dengan atribut, *method*, dan relasi antar kelas.

## Modul Pembeli (Customer)
- `activity-b-auth.puml` & `sequence-b-auth.puml` : Registrasi & Login Akun Pembeli
- `activity-b-checkout.puml` & `sequence-b-checkout.puml` : Checkout Pesanan & Cek Ongkos Kirim (Integrasi API RajaOngkir)
- `activity-b-bayar.puml` & `sequence-b-bayar.puml` : Melakukan Pembayaran (Integrasi Webhook API Midtrans)
- `activity-b-invoice.puml` & `sequence-b-invoice.puml` : Unduh Invoice Pembelian (Report 8)

## Modul Penjual (Pemilik UMKM)
- `activity-s-auth.puml` & `sequence-s-auth.puml` : Registrasi Toko (dengan persetujuan Administrator)
- `activity-s-produk.puml` & `sequence-s-produk.puml` : Pengelolaan Produk dan Varian (One-to-Many Database)
- `activity-s-order.puml` & `sequence-s-order.puml` : Proses dan Update Status Pesanan (Menginput nomor resi pengiriman)
- `activity-s-rep1.puml` & `sequence-s-rep1.puml` : Lihat Dashboard Performa Penjualan (Report 1)
- `activity-s-rep2.puml` & `sequence-s-rep2.puml` : Unduh Laporan Penjualan Excel/PDF (Report 2)
- `activity-s-rep3.puml` & `sequence-s-rep3.puml` : Lihat Laporan Produk Terlaris (Report 3)
- `activity-s-rep4.puml` & `sequence-s-rep4.puml` : Unduh Laporan Stok Menipis untuk opname (Report 4)
- `activity-s-rep5.puml` & `sequence-s-rep5.puml` : Cetak Estimasi Pendapatan Kotor (Report 5)
- `activity-s-rep6.puml` & `sequence-s-rep6.puml` : Unduh Laporan Pembatalan Pesanan (Report 6)
- `activity-s-rep7.puml` & `sequence-s-rep7.puml` : Cetak Data Pelanggan Loyal / *Top Spender* (Report 7)
- `activity-s-rep8.puml` & `sequence-s-rep8.puml` : Cetak Invoice Pengiriman standar (Report 8)

## Modul Administrator
- `activity-a-rep.puml` & `sequence-a-rep.puml` : Dashboard Rekapitulasi Platform & Grafik Pertumbuhan Toko (Report 9, 10)

> **Catatan Teknis**: 
> Mengingat laporan (Rep1 - Rep10) memiliki alur logis sistematis yang serupa (Filter Tanggal -> Sistem Query/Agregasi Database -> Tampilkan/Ekspor File format PDF/Excel), maka alur Activity Diagram untuk modul pelaporan diseragamkan struktur *swimlane*-nya untuk efisiensi perancangan sistem dan pemrograman. Diagram berfokus pada integrasi antar Aktor dan Sistem.