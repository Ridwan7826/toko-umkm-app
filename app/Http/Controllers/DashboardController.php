<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ReportService;

class DashboardController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($request->has('refresh')) {
            if ($user->role === 'admin') {
                \Illuminate\Support\Facades\Cache::forget('admin_dashboard_data');
            } elseif ($user->role === 'penjual' && $user->shop) {
                \Illuminate\Support\Facades\Cache::forget('seller_dashboard_data_' . $user->shop->id);
            }
            return redirect()->route('dashboard')->with('success', 'Data dashboard berhasil diperbarui!');
        }

        if ($user->role === 'admin') {
            $data = $this->reportService->getAdminDashboardData();
            return view('admin.dashboard', $data);
            
        } elseif ($user->role === 'penjual') {
            $shop = $user->shop;
            if (!$shop) {
                return redirect()->route('seller.shop.index')->with('warning', 'Silakan buat profil toko terlebih dahulu.');
            }
            $data = $this->reportService->getSellerDashboardData($shop->id);
            return view('seller.dashboard', $data);
            
        } else {
            // Buyer
            return view('buyer.dashboard');
        }
    }
}
