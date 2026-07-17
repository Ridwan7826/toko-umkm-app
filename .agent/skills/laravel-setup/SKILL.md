---
name: Laravel Setup & Authentication
description: Panduan langkah demi langkah inisialisasi awal proyek Laravel 10 dan instalasi Laravel Breeze untuk TokoKita.
---

# Instruksi Skill: Laravel Setup & Breeze Auth

Berkas pedoman ini menjadi rujukan wajib ketika agen ditugaskan untuk melakukan instalasi sistem otentikasi awal ataupun pengaturan *environment* pada *framework* Laravel 10 di *workspace* ini.

## 1. Prasyarat & Lingkungan Dasar
- **Versi PHP**: Minimum **PHP 8.1+** (Prasyarat mutlak berjalannya Laravel 10).
- **Database**: MySQL/MariaDB.

## 2. Konfigurasi Koneksi Database (`.env`)
Untuk terhubung dengan rancangan basis data yang telah kita sepakati, agen harus memastikan bahwa parameter berikut terekam secara persis di fail `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toko_kita
DB_USERNAME=root
DB_PASSWORD=
```
*(Catatan: Karakter garis bawah/underscore wajib ada pada nama database `toko_kita`)*.

## 3. Instalasi *Package* Pendukung Wajib
Dalam sistem *e-commerce*, pastikan *packages* krusial berikut ini diikutsertakan di awal:
```bash
# Komponen untuk fitur Autentikasi dasar
composer require laravel/breeze --dev
```

## 4. Langkah Setup Autentikasi (Breeze + Blade + Tailwind)
Proyek TokoKita akan menggunakan antarmuka modern yang dikompilasi melalui bundel **Blade + Tailwind CSS**. 
Terapkan deretan *command* berikut secara sekuensial (berurutan) setiap kali melakukan penyetelan Breeze:

```bash
# 1. Meng-generate scaffolding UI & Controllers Auth
php artisan breeze:install blade

# 2. Mengunduh dan memasang library Node.js (seperti Tailwind/Vite)
npm install

# 3. Mengkompilasi aset UI frontend
npm run build

# 4. Mengeksekusi sisa migrasi tabel (seperti tabel 'users' yang mungkin diremajakan oleh Breeze)
php artisan migrate
```

> **Aturan Keamanan Eksekusi Terminal**: Agen harus mengeksekusi tahapan NPM secara terpisah dari *Composer* agar dapat mendeteksi dan melaporkan pesan *error* pembangun aset dengan lebih tajam.
