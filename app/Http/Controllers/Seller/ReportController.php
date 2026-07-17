<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $shop = Auth::user()->shop;
        
        if (!$shop) {
            return redirect()->route('seller.shop.index')->with('error', 'Silakan buat toko terlebih dahulu.');
        }

        $reportData = $this->reportService->getSellerReportData($shop->id, $request->start_date, $request->end_date);
        $topProducts = $this->reportService->getTopProducts($shop->id);
        
        $reportData['topProducts'] = $topProducts;

        return view('seller.reports.index', $reportData);
    }

    private function getShopOrAbort()
    {
        $shop = Auth::user()->shop;
        if (!$shop) abort(403, 'Toko tidak ditemukan.');
        return $shop;
    }

    public function pdfPenjualan(Request $request)
    {
        $shop = $this->getShopOrAbort();
        $reportData = $this->reportService->getSellerReportData($shop->id, $request->start_date, $request->end_date);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.reports.penjualan', $reportData);
        return $pdf->stream('Laporan_Penjualan_'.$shop->name.'.pdf');
    }

    public function pdfProdukTerlaris()
    {
        $shop = $this->getShopOrAbort();
        $topProducts = $this->reportService->getTopProducts($shop->id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.reports.produk_terlaris', compact('topProducts', 'shop'));
        return $pdf->stream('Laporan_Produk_Terlaris_'.$shop->name.'.pdf');
    }

    public function pdfEstimasiPendapatan()
    {
        $shop = $this->getShopOrAbort();
        $monthlyRevenue = $this->reportService->getEstimatedRevenue($shop->id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.reports.estimasi_pendapatan', compact('monthlyRevenue', 'shop'));
        return $pdf->stream('Laporan_Estimasi_Pendapatan_'.$shop->name.'.pdf');
    }

    public function pdfPelangganLoyal()
    {
        $shop = $this->getShopOrAbort();
        $topCustomers = $this->reportService->getTopCustomers($shop->id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.reports.pelanggan_loyal', compact('topCustomers', 'shop'));
        return $pdf->stream('Laporan_Pelanggan_Loyal_'.$shop->name.'.pdf');
    }

    public function excelPenjualan(Request $request)
    {
        $shop = $this->getShopOrAbort();
        $orders = $this->reportService->getSuccessfulOrders($shop->id, $request->start_date, $request->end_date);
        
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SellerSalesExport($orders), 'Laporan_Penjualan_'.$shop->name.'.xlsx');
    }

    public function excelStokMenipis()
    {
        $shop = $this->getShopOrAbort();
        $products = $this->reportService->getLowStockProducts($shop->id);
        
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SellerLowStockExport($products), 'Laporan_Stok_Menipis_'.$shop->name.'.xlsx');
    }

    public function excelPembatalan(Request $request)
    {
        $shop = $this->getShopOrAbort();
        $orders = $this->reportService->getCancelledOrders($shop->id, $request->start_date, $request->end_date);
        
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SellerCancelledOrdersExport($orders), 'Laporan_Pembatalan_Pesanan_'.$shop->name.'.xlsx');
    }
}
