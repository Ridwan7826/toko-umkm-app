---
name: generate_crud
description: Panduan agen dalam meng-generate fitur CRUD (Controller, Model, View) yang sesuai dengan arsitektur Service Layer di aplikasi TokoKita.
---

# 1. Tujuan
Skill ini memandu proses pembuatan fitur CRUD (Create, Read, Update, Delete) agar selalu mengadopsi pola arsitektur **Service Layer**.

# 2. Aturan Utama (Service Layer Pattern)
Setiap kali diminta untuk membuat fitur CRUD baru, agen **DIWAJIBKAN**:
1. **Tidak Menempatkan Logika Bisnis di Controller**: Controller HANYA bertugas menerima `Request`, memvalidasi input sederhana (jika tidak menggunakan FormRequest), memanggil Service, dan mengembalikan `Response` atau `View`.
2. **Membuat Kelas Service**: Buatlah class Service di direktori `app/Services/` (misalnya `app/Services/ProductService.php`).
3. **Injeksi Dependensi**: Lakukan injeksi Service class tersebut ke dalam Controller melalui konstruktor.
4. **Logika Database di Service**: Proses seperti `create`, `update`, `delete`, manipulasi *slug*, penanganan *file upload*, operasi *DB Transaction* (seperti `DB::beginTransaction()`), relasi kompleks (seperti *sync* pivot table), dan integrasi pihak ketiga (API) mutlak diletakkan di dalam Service class. Jangan letakkan kueri Eloquent kompleks di Controller.

# 3. Contoh Implementasi

## 3.1 Controller (app/Http/Controllers/ExampleController.php)
```php
<?php
namespace App\Http\Controllers;

use App\Services\ExampleService;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected ExampleService $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function store(Request $request)
    {
        $data = $request->validate([...]);
        $result = $this->exampleService->createRecord($data);

        return redirect()->route('example.index')->with('success', 'Data created!');
    }
}
```

## 3.2 Service (app/Services/ExampleService.php)
```php
<?php
namespace App\Services;

use App\Models\Example;

class ExampleService
{
    public function createRecord(array $data)
    {
        // Business logic here
        return Example::create($data);
    }
}
```

# 4. Kapan Menggunakan Skill Ini
Gunakan skill ini secara implisit setiap kali pengguna meminta "buatkan CRUD untuk fitur X", "buatkan fungsi pendaftaran", atau operasi sejenis yang berurusan dengan pemrosesan data (logika bisnis).
