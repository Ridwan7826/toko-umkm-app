<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Shop;
use App\Models\Order;
use App\Models\ShopDailySale;
use Carbon\Carbon;

class DailySummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summary {--date= : The date to summarize (YYYY-MM-DD). Defaults to yesterday.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Summarize daily shop sales into the shop_daily_sales table.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateArg = $this->option('date');
        
        if ($dateArg) {
            $date = Carbon::parse($dateArg)->format('Y-m-d');
        } else {
            // Default to yesterday
            $date = Carbon::yesterday()->format('Y-m-d');
        }

        $this->info("Starting daily summary aggregation for date: {$date}");

        // Get all shops
        $shops = Shop::all();
        
        $count = 0;
        foreach ($shops as $shop) {
            // Get orders for this shop on this date
            $orders = Order::where('shop_id', $shop->id)
                ->whereDate('created_at', $date)
                ->get();

            $totalOrders = $orders->count();
            
            // Only aggregate if there are orders, or we can just save 0s to keep track of active shops.
            // Saving 0s is fine.
            $completedOrders = $orders->where('status', 'selesai')->count();
            $cancelledOrders = $orders->where('status', 'dibatalkan')->count();
            
            $grossRevenue = $orders->where('status', 'selesai')->sum(function ($order) {
                return $order->total_product_price + $order->shipping_cost;
            });

            // Upsert into shop_daily_sales
            ShopDailySale::updateOrCreate(
                ['shop_id' => $shop->id, 'date' => $date],
                [
                    'total_orders' => $totalOrders,
                    'gross_revenue' => $grossRevenue,
                    'completed_orders' => $completedOrders,
                    'cancelled_orders' => $cancelledOrders,
                ]
            );
            $count++;
        }

        $this->info("Successfully generated daily summary for {$count} shops.");
        return Command::SUCCESS;
    }
}
