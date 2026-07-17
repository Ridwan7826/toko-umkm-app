<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        $reportData = $this->reportService->getAdminReportData();
        return view('admin.reports.index', $reportData);
    }

    public function excelTransaksiPlatform()
    {
        $transactions = $this->reportService->getPlatformTransactions();
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AdminTransactionExport($transactions), 'Laporan_Transaksi_Platform.xlsx');
    }

    public function sellerPerformance()
    {
        $performance = $this->reportService->getSellerPerformanceLast3Months();
        
        $chartData = [
            'labels' => $performance->pluck('shop.name')->toArray(),
            'data' => $performance->pluck('total_revenue')->toArray(),
        ];

        return view('admin.reports.seller-performance', compact('performance', 'chartData'));
    }
}
