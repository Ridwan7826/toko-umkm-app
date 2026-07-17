---
name: Laravel Eloquent Model Conventions
description: Pedoman agen dalam membuat atau memodifikasi kelas Model Eloquent untuk proyek TokoKita.
---

# Instruksi Skill: Konvensi Model Eloquent TokoKita

Gunakan pedoman ini ketika Anda diminta untuk memodifikasi, merancang, atau membuat ulang sebuah kelas *Model Eloquent* pada repositori ini. 

Seluruh model di `app/Models/` harus konsisten mengikuti arsitektur yang telah dicanangkan sebagai berikut:

## 1. Proteksi Mass-Assignment (`$fillable`)
- **DILARANG** menggunakan `$guarded = []` untuk alasan keamanan e-commerce.
- Semua model **wajib** mendefinisikan *array* `$fillable` secara eksplisit, mendaftarkan seluruh nama kolom yang boleh diisi oleh *user input*.

## 2. Implementasi `SoftDeletes`
- Apabila fail migrasinya menyertakan `$table->softDeletes()`, maka Model terkait **WAJIB** menggunakan `use Illuminate\Database\Eloquent\SoftDeletes;` di awal deklarasi *class*.
- Tabel krusial seperti `Product`, `ProductVariant`, `Order`, dan `User` menggunakan *Soft Deletes* demi integritas riwayat pelaporan.

## 3. Penamaan Fungsi Relasi (Relationships)
- **One-to-Many / BelongsToMany**: Nama fungsi harus berbentuk jamak (*plural*). Contoh: `public function products()`, `public function orderDetails()`.
- **BelongsTo / HasOne**: Nama fungsi harus berbentuk tunggal (*singular*). Contoh: `public function shop()`, `public function user()`.
- **Pivot Tables**: Entitas murni N:M tanpa logika bisnis (seperti `category_product` atau `wishlists`) **tidak boleh dibuatkan fail model**. Gunakan `belongsToMany()` dari dalam model asalnya, dan tambahkan `->withTimestamps()` jika tabel pivot memiliki *timestamps*.

## 4. Pendeklarasian Kunci Konvensi
- Tidak perlu mendeklarasikan `$table` atau `$primaryKey` secara eksplisit, asalkan nama tabel mengikuti standar Laravel (misal: bentuk jamak dari nama Model) dan kolom utama bernama `id`.
- Kunci asing (*foreign key*) juga tidak perlu ditulis di parameter relasi jika sudah mengikuti format `<nama_model_singular>_id` (misal: `shop_id`).

## 5. Type Casting
- Manfaatkan larik `$casts` jika ada kolom *date/time*, *JSON*, atau *Boolean* yang perlu dikonversi secara otomatis. Contoh: `'is_active' => 'boolean'`, `'published_at' => 'datetime'`.
