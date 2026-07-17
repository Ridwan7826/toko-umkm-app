<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ShopDailySale extends Model
{
    protected $fillable = ['shop_id', 'date', 'total_orders', 'gross_revenue', 'completed_orders', 'cancelled_orders'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}