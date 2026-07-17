<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $shop = auth()->user()->shop;
        if (!$shop) return redirect()->route('dashboard')->with('error', 'Toko tidak ditemukan.');

        $products = $this->productService->getShopProducts($shop->id, $request->only(['search', 'category_id', 'min_price', 'max_price']));
        $categories = Category::all();

        return view('seller.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $shop = auth()->user()->shop;
        if (!$shop) return redirect()->route('dashboard')->with('error', 'Toko tidak ditemukan.');

        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $shop = auth()->user()->shop;

        try {
            $this->productService->createProduct($shop->id, $request->all(), $request->file('image'));
            return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        $shop = auth()->user()->shop;
        $product = $this->productService->getShopProductById($shop->id, $id);
        
        return view('seller.products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $shop = auth()->user()->shop;
        $product = $this->productService->getShopProductById($shop->id, $id);
        $categories = Category::all();
        
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $shop = auth()->user()->shop;

        try {
            $this->productService->updateProduct($shop->id, $id, $request->all(), $request->file('image'));
            return redirect()->route('seller.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        $shop = auth()->user()->shop;

        try {
            $this->productService->deleteProduct($shop->id, $id);
            return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
