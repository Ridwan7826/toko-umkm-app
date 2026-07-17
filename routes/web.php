<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShopController as AdminShopController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

// Seller Controllers
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\ShopController as SellerShopController;
use App\Http\Controllers\Seller\ReportController as SellerReportController;

// Buyer Controllers
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\WishlistController;
use App\Http\Controllers\Buyer\CheckoutController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==========================================
// ADMIN ROUTES (Hanya untuk Admin)
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('shops', AdminShopController::class)->only(['index', 'show', 'update']);
    Route::get('reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('reports/seller-performance', [AdminReportController::class, 'sellerPerformance'])->name('reports.seller-performance');
    Route::get('reports/excel/transaksi-platform', [AdminReportController::class, 'excelTransaksiPlatform'])->name('reports.excel.transaksi-platform');
    Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class)->only(['index', 'update']);
});

// ==========================================
// SELLER ROUTES (Hanya untuk UMKM/Penjual)
// ==========================================
Route::middleware(['auth', 'role:penjual'])->prefix('seller')->name('seller.')->group(function () {
    Route::resource('shop', SellerShopController::class)->only(['index', 'edit', 'update']);
    Route::resource('products', ProductController::class);
    Route::resource('orders', SellerOrderController::class)->only(['index', 'show', 'update']);
    Route::get('orders/{order}/invoice', [SellerOrderController::class, 'printInvoice'])->name('orders.invoice');
    Route::get('reports', [SellerReportController::class, 'index'])->name('reports.index');
    Route::get('reports/pdf/penjualan', [SellerReportController::class, 'pdfPenjualan'])->name('reports.pdf.penjualan');
    Route::get('reports/pdf/produk-terlaris', [SellerReportController::class, 'pdfProdukTerlaris'])->name('reports.pdf.produk-terlaris');
    Route::get('reports/pdf/estimasi-pendapatan', [SellerReportController::class, 'pdfEstimasiPendapatan'])->name('reports.pdf.estimasi-pendapatan');
    Route::get('reports/pdf/pelanggan-loyal', [SellerReportController::class, 'pdfPelangganLoyal'])->name('reports.pdf.pelanggan-loyal');
    Route::get('reports/excel/penjualan', [SellerReportController::class, 'excelPenjualan'])->name('reports.excel.penjualan');
    Route::get('reports/excel/stok-menipis', [SellerReportController::class, 'excelStokMenipis'])->name('reports.excel.stok-menipis');
    Route::get('reports/excel/pembatalan', [SellerReportController::class, 'excelPembatalan'])->name('reports.excel.pembatalan');
});

// ==========================================
// BUYER ROUTES (Hanya untuk Pembeli)
// ==========================================
Route::middleware(['auth', 'role:pembeli'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);
    Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::resource('orders', BuyerOrderController::class)->only(['index', 'show']);
    Route::get('orders/{order}/invoice', [BuyerOrderController::class, 'printInvoice'])->name('orders.invoice');
    Route::resource('reviews', \App\Http\Controllers\Buyer\ReviewController::class)->only(['create', 'store', 'index']);
});

Route::get('/product/{product}', [\App\Http\Controllers\PublicProductController::class, 'show'])->name('public.products.show');

require __DIR__.'/auth.php';
