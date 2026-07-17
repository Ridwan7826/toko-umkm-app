<?php

namespace App\Services;

use App\Models\ShopDailySale;

class ReportService
{
    /**
     * Get aggregate report data for the entire platform (Admin).
     */
    public function getAdminReportData()
    {
        $dailySales = ShopDailySale::with('shop')->orderBy('date', 'desc')->get();

        $totalRevenue = $dailySales->sum('gross_revenue');
        $totalOrders = $dailySales->sum('completed_orders');

        return [
            'dailySales' => $dailySales,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
        ];
    }

    /**
     * Get aggregate report data for a specific shop (Seller).
     */
    public function getSellerReportData($shopId, $startDate = null, $endDate = null)
    {
        $query = ShopDailySale::where('shop_id', $shopId);
        
        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        $dailySales = $query->orderBy('date', 'desc')->get();

        $totalRevenue = $dailySales->sum('gross_revenue');
        $totalOrders = $dailySales->sum('completed_orders');

        return [
            'dailySales' => $dailySales,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
        ];
    }

    /**
     * Get Top 5 Best Selling Products for a Shop
     */
    public function getTopProducts($shopId)
    {
        // Using OrderDetail to sum up sold variants for products belonging to this shop
        // Alternatively, since products belong to a shop, we can query order details where order status is selesai
        return \App\Models\OrderDetail::whereHas('order', function($q) use ($shopId) {
            $q->where('shop_id', $shopId)->where('status', 'selesai');
        })
        ->selectRaw('variant_id, SUM(quantity) as total_sold')
        ->groupBy('variant_id')
        ->orderByDesc('total_sold')
        ->take(5)
        ->with('variant.product')
        ->get()
        ->map(function($detail) {
            return [
                'name' => $detail->variant->product->name . ' (' . $detail->variant->name . ')',
                'sku' => $detail->variant->sku,
                'total_sold' => $detail->total_sold
            ];
        });
    }

    /**
     * Get Estimated Revenue per month
     */
    public function getEstimatedRevenue($shopId)
    {
        // Group by month-year
        $dailySales = ShopDailySale::where('shop_id', $shopId)->get();
        
        $monthlyRevenue = [];
        foreach ($dailySales as $sale) {
            $month = date('F Y', strtotime($sale->date));
            if (!isset($monthlyRevenue[$month])) {
                $monthlyRevenue[$month] = [
                    'gross' => 0,
                    'orders' => 0,
                    'estimated_net' => 0,
                ];
            }
            $monthlyRevenue[$month]['gross'] += $sale->gross_revenue;
            $monthlyRevenue[$month]['orders'] += $sale->completed_orders;
            // Assuming platform fee is 5%
            $monthlyRevenue[$month]['estimated_net'] += ($sale->gross_revenue * 0.95);
        }

        return $monthlyRevenue;
    }

    /**
     * Get Top Spenders / Loyal Customers
     */
    public function getTopCustomers($shopId)
    {
        return \App\Models\Order::where('shop_id', $shopId)
            ->where('status', 'selesai')
            ->selectRaw('user_id, COUNT(id) as total_orders, SUM(total_product_price + shipping_cost) as total_spent')
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->take(10)
            ->with('user')
            ->get();
    }

    public function getLowStockProducts($shopId, $threshold = 5)
    {
        return \App\Models\ProductVariant::whereHas('product', function($q) use ($shopId) {
            $q->where('shop_id', $shopId);
        })
        ->where('stock', '<', $threshold)
        ->with('product')
        ->orderBy('stock', 'asc')
        ->get();
    }

    public function getCancelledOrders($shopId, $startDate = null, $endDate = null)
    {
        $query = \App\Models\Order::where('shop_id', $shopId)
            ->where('status', 'dibatalkan');
            
        if ($startDate) $query->where('created_at', '>=', $startDate . ' 00:00:00');
        if ($endDate) $query->where('created_at', '<=', $endDate . ' 23:59:59');

        return $query->orderBy('created_at', 'desc')
            ->with(['user', 'details.variant.product'])
            ->get();
    }

    public function getSuccessfulOrders($shopId, $startDate = null, $endDate = null)
    {
        $query = \App\Models\Order::where('shop_id', $shopId)
            ->where('status', 'selesai');
            
        if ($startDate) $query->where('created_at', '>=', $startDate . ' 00:00:00');
        if ($endDate) $query->where('created_at', '<=', $endDate . ' 23:59:59');

        return $query->orderBy('created_at', 'desc')
            ->with(['user', 'details.variant.product'])
            ->get();
    }

    public function getPlatformTransactions()
    {
        return ShopDailySale::with('shop')->orderBy('date', 'desc')->get();
    }

    public function getAdminDashboardData()
    {
        return \Illuminate\Support\Facades\Cache::remember('admin_dashboard_data', 600, function () {
            // 1. KPI Cards
            $totalRevenue = ShopDailySale::sum('gross_revenue');
            $totalOrders = ShopDailySale::sum('completed_orders');
            $totalShops = \App\Models\Shop::count();
            
            $allOrdersCount = ShopDailySale::sum('total_orders');
            $totalCancelled = ShopDailySale::sum('cancelled_orders');
            
            $aov = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
            $cancelRate = $allOrdersCount > 0 ? ($totalCancelled / $allOrdersCount) * 100 : 0;

            // 2. Area Chart: Pertumbuhan Toko Baru (6 bulan terakhir)
            $newShopsTrend = \App\Models\Shop::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(id) as total')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total', 'month')
                ->toArray();

            // 3. Bar Chart: GMV Platform (6 bulan terakhir)
            $gmvTrend = ShopDailySale::selectRaw('DATE_FORMAT(date, "%Y-%m") as month, SUM(gross_revenue) as total_revenue')
                ->where('date', '>=', now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('total_revenue', 'month')
                ->toArray();

            return [
                'totalRevenue' => $totalRevenue,
                'totalOrders' => $totalOrders,
                'totalShops' => $totalShops,
                'aov' => $aov,
                'cancelRate' => $cancelRate,
                'newShopsTrend' => $newShopsTrend,
                'gmvTrend' => $gmvTrend,
            ];
        });
    }

    public function getSellerDashboardData($shopId)
    {
        return \Illuminate\Support\Facades\Cache::remember('seller_dashboard_data_' . $shopId, 600, function () use ($shopId) {
            // 1. Line Chart: Pendapatan kotor 30 hari terakhir
            $revenueTrend = ShopDailySale::where('shop_id', $shopId)
                ->where('date', '>=', now()->subDays(30))
                ->orderBy('date')
                ->pluck('gross_revenue', 'date')
                ->toArray();

            // 2. Pie Chart: Komposisi Status Pesanan Aktif
            $orderStatusComposition = \App\Models\Order::where('shop_id', $shopId)
                ->selectRaw('status, COUNT(id) as total')
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // 3. KPI
            $totalRevenue = array_sum($revenueTrend);
            
            $overallSales = ShopDailySale::where('shop_id', $shopId)
                ->selectRaw('SUM(gross_revenue) as rev, SUM(completed_orders) as comp, SUM(total_orders) as tot, SUM(cancelled_orders) as canc')
                ->first();
                
            $aov = ($overallSales && $overallSales->comp > 0) ? $overallSales->rev / $overallSales->comp : 0;
            $cancelRate = ($overallSales && $overallSales->tot > 0) ? ($overallSales->canc / $overallSales->tot) * 100 : 0;
            
            return [
                'revenueTrend' => $revenueTrend,
                'orderStatusComposition' => $orderStatusComposition,
                'totalRevenue30Days' => $totalRevenue,
                'aov' => $aov,
                'cancelRate' => $cancelRate,
            ];
        });
    }

    public function getSellerPerformanceLast3Months()
    {
        $threeMonthsAgo = now()->subMonths(3)->startOfMonth();

        // Get total gross_revenue and completed_orders per shop over the last 3 months
        $performance = ShopDailySale::where('date', '>=', $threeMonthsAgo)
            ->selectRaw('shop_id, SUM(gross_revenue) as total_revenue, SUM(completed_orders) as total_orders')
            ->groupBy('shop_id')
            ->with('shop')
            ->orderByDesc('total_revenue')
            ->get();

        return $performance;
    }
}
