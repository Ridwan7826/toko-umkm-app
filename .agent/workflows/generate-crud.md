# Workflow: Pembangkit Otomatis CRUD E-Commerce (Generate-CRUD)

Workflow ini digunakan oleh agen untuk mengotomatisasi pembuatan infrastruktur utuh sebuah Modul (*Entity*) baru di dalam kerangka kerja TokoKita.

## Masukan (Input)
Workflow ini mengharapkan agen untuk mengidentifikasi argumen:
- **`[EntityName]`**: Nama entitas tunggal dengan format *PascalCase* (contoh: `Voucher`, `PromoBanner`).
- **`[Role]`**: (Opsional) Penempatan area kerja berdasarkan aktor, misal `Admin`, `Seller`, atau `Buyer`. Jika kosong, secara *default* anggap untuk modul `Admin`.

## Langkah-langkah Eksekusi

### 1. Inisiasi Komponen Dasar (Artisan)
Jalankan rentetan perintah konsol secara berurutan untuk menciptakan kerangka awal (Ganti `Entity` dengan `[EntityName]`):
```bash
php artisan make:model Entity -m
php artisan make:request StoreEntityRequest
php artisan make:request UpdateEntityRequest
php artisan make:controller Role/EntityController --resource
```
*Catatan: Pastikan `[Role]` pada rute Controller disesuaikan huruf kapital awalnya (misal: `Admin/VoucherController`).*

### 2. Standardisasi Kode PHP (Mengacu pada Skills)
- **Model**: Daftarkan atribut `$fillable`. Terapkan *SoftDeletes* bila diperlukan. Patuhi pedoman di `.agent/skills/laravel-model/SKILL.md`.
- **Migration**: Definisikan tipe data, konstrain relasi `foreignId`, `constrained()->cascadeOnDelete()`, dan `timestamps()`.

### 3. Pendaftaran Perutean (*Routing*)
Buka `routes/web.php` dan carilah *Route Group* yang sesuai dengan `[Role]`. Daftarkan *resource route* entitas baru tersebut di dalam blok fungsi grupnya.
Contoh untuk `Voucher` di blok Admin:
```php
Route::resource('vouchers', VoucherController::class);
```

### 4. Produksi Tampilan (*Views*) Premium
Buat struktur direktori `resources/views/[role]/[entities]/`.
Gunakan perkakas pembentuk atau *script* untuk merakit keempat berkas *Blade* dengan konvensi berikut:
- **Pembungkus Utama**: Seluruh berkas wajib diawali dengan `<x-app-layout>` dan `<x-slot name="header">`.
- **index.blade.php**: Bangun tabel estetik dengan elemen `.overflow-x-auto.shadow-sm.rounded-xl`, berisikan kolom aksi (Edit, Hapus).
- **create.blade.php & edit.blade.php**: Gunakan kerangka formulir berkelas *Tailwind* (contoh: `input.ring-blue-500.rounded-xl`), pasangkan tombol `Simpan` dan `Batal`.
- **show.blade.php**: Menampilkan rincian profil data menggunakan format definisi label bergaris (*border-b*).

### 5. Finalisasi & Integrasi Menu
Buka tata letak master di `resources/views/layouts/app.blade.php`.
Tambahkan tautan menu baru (dengan elemen ikon SVG seragam) di blok `<aside>` *Sidebar* yang mengarah ke rute entitas tersebut:
```blade
<a href="{{ route('admin.vouchers.index') }}" class="flex items-center p-3 text-slate-700 rounded-xl hover:bg-blue-50 hover:text-blue-700 group transition">
    <span class="ml-3">Manajemen Voucher</span>
</a>
```

### 6. Verifikasi Kesatuan Arsitektur
Uji fungsionalitas rute dengan memeriksa hasil dari perintah `php artisan route:list`. Pastikan tidak ada konflik *namespace* kontroler maupun kesalahan tanda koma di *routes/web.php*.
