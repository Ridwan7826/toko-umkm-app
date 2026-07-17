<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['shop_id', 'name', 'slug', 'description', 'weight'];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function wishlistedByUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeSearch($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeFilterCategory($query, $categoryId)
    {
        return $query->whereHas('categories', function ($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        });
    }

    public function scopeFilterPrice($query, $min, $max)
    {
        return $query->whereHas('variants', function ($q) use ($min, $max) {
            if (!is_null($min)) {
                $q->where('price', '>=', $min);
            }
            if (!is_null($max)) {
                $q->where('price', '<=', $max);
            }
        });
    }
}