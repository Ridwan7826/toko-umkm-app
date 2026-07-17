---
name: Laravel Playwright E2E Testing
description: Panduan agen dalam merancang dan mengeksekusi pengujian End-to-End menggunakan Playwright untuk proyek TokoKita (konvensi struktur, page objects, dan fixtures).
---

# Panduan Pengujian E2E (Playwright) TokoKita

Skill ini merangkum konvensi baku untuk menulis pengujian fungsional dan perilaku (*End-to-End Testing*) menggunakan Playwright dalam aplikasi E-Commerce TokoKita.

## 1. Struktur Direktori
Seluruh berkas pengujian wajib ditempatkan di dalam folder `tests/e2e/`. Jika Anda membuat berkas pendukung, ikuti topologi ini:
```text
tests/e2e/
├── specs/             # Berkas utama pengujian (contoh: admin-dashboard.spec.ts)
├── fixtures/          # Pengaturan setup state (Otentikasi, Role)
├── pages/             # Abstraksi Page Object Model (POM)
└── helpers/           # Utilitas tambahan (koneksi ke database, data generator)
```

## 2. Konvensi Penamaan (*Naming Convention*)
Setiap berkas spesifikasi (*spec*) harus:
1. Dikategorikan berdasarkan peran/aktor (admin, seller, buyer) atau modul utama (auth, checkout).
2. Diakhiri dengan sufiks `.spec.ts`.
3. Contoh: `seller-product-catalog.spec.ts`, `buyer-checkout-flow.spec.ts`.

## 3. Otentikasi dan *Fixtures* (Role-Based Login)
Di aplikasi TokoKita, pengujian E2E sangat bergantung pada sesi *login* tiga peran utama. Alih-alih melakukan *login* berulang secara manual di tiap `.spec.ts`, gunakan metode *Fixtures* atau simpanan *State* Playwright.
- Anda dapat memanfaatkan global setup atau *custom fixture* di Playwright yang menimpa objek `page`.
- Agen wajib membuat *helper* untuk mengambil kredensial secara dinamis jika diperlukan:
```typescript
// tests/e2e/helpers/db.ts
export const getSeederUser = (role: 'admin' | 'penjual' | 'pembeli') => {
   // Kembalikan kredensial baku berdasarkan seeder UserSeeder.php
   // Admin: admin@tokokita.com
   // Seller: seller@tokokita.com
   // Buyer: buyer@tokokita.com
};
```

## 4. Pola *Page Object Model* (POM)
Halaman yang frekuensi interaksinya tinggi (seperti Halaman Login atau Halaman Dasbor Utama) wajib dirangkum ke dalam kelas tersendiri (POM).
- **Halaman Login** (`tests/e2e/pages/LoginPage.ts`): Memiliki *method* `goto()`, `fillCredentials(email, password)`, dan `submit()`.
- **Halaman Dasbor** (`tests/e2e/pages/DashboardPage.ts`): Memiliki *locator* spesifik untuk memvalidasi *Role Badge*, memeriksa tautan di *Sidebar*, serta memastikan notifikasi *Flash Message* muncul.

## 5. Standarisasi Asersi (*Assertions*)
- **Elemen Tailwind**: Ketahui bahwa antarmuka kita dibangun menggunakan Tailwind CSS. Saat menyeleksi atau memverifikasi warna, lebih aman memvalidasi visibilitas kelas (contoh: `.bg-red-50` untuk pesan eror) atau teksnya langsung (`expect(page.getByText('Berhasil!')).toBeVisible()`).
- Selalu prioritaskan lokator yang berorientasi pengguna (contoh: `getByRole`, `getByLabel`, `getByText`) sebelum jatuh kembali ke selektor CSS generik.

---
**Penting**: Jika sistem meminta agen untuk membuat pengujian E2E Playwright, bacalah seluruh pedoman di file ini sebelum Anda menulis satu baris kode pun.

## 6. Skenario Uji dengan *Mock API Eksternal*
Aplikasi e-commerce TokoKita bergantung pada API pihak ketiga (RajaOngkir, Midtrans). Mengingat keterbatasan otentikasi kunci asli pada lingkungan pengujian, skenario Playwright disarankan untuk memotong (Bypass) API Eksternal dengan cara:
- Merancang kelas Service (misal `CheckoutService`) sedemikian rupa sehingga ia mengembalikan *dummy* JSON jika mendeteksi ENV testing, atau
- Memanfaatkan fitur `page.route()` pada Playwright untuk meretas (Intercept) pemanggilan *fetch* ke URL API Eksternal, lalu memberikan simulasi *mock response* (HTTP 200) guna mempertahankan alur E2E yang mulus.

## 7. Referensi Perintah CLI Playwright
Berikut adalah daftar perintah yang sering digunakan untuk eksekusi dan *debugging* pengujian:
- **Jalankan seluruh test e2e**:
  `npx playwright test`
- **Jalankan satu file saja**:
  `npx playwright test produk.spec.js`
- **Jalankan dengan tampilan browser terlihat** (untuk *debugging visual*):
  `npx playwright test --headed`
- **Jalankan satu test spesifik dalam mode debug interaktif**:
  `npx playwright test --debug`
- **Buka laporan HTML setelah eksekusi selesai**:
  `npx playwright show-report docs/testing/playwright-report`
- **Buka trace viewer untuk satu test yang gagal**:
  `npx playwright show-trace test-results/produk-edit/trace.zip`
