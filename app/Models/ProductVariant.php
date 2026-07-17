<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_id', 'name', 'sku', 'price', 'stock', 'weight'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'variant_id');
    }
}