<?php

namespace App\Services;

use App\Models\Review;
use App\Models\Order;
use App\Models\Product;

class ReviewService
{
    public function getUserReviews($userId)
    {
        return Review::where('user_id', $userId)->with('product')->latest()->get();
    }

    public function getReviewableOrderAndProduct($orderId, $productId, $userId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', $userId)
            ->where('status', 'selesai')
            ->firstOrFail();
            
        $product = Product::findOrFail($productId);
        
        return compact('order', 'product');
    }

    public function createReview($userId, array $data)
    {
        return Review::create([
            'user_id' => $userId,
            'product_id' => $data['product_id'],
            'order_id' => $data['order_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'],
            'status' => 'pending',
        ]);
    }

    // Admin Analysis Methods
    public function getAverageRatingPerProduct()
    {
        return Product::withAvg(['reviews' => function($q) {
                $q->where('status', 'approved');
            }], 'rating')
            ->withCount(['reviews' => function($q) {
                $q->where('status', 'approved');
            }])
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_avg_rating')
            ->get();
    }

    public function getRatingDistribution()
    {
        $distribution = Review::where('status', 'approved')
            ->selectRaw('rating, count(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        $result = [];
        for ($i = 1; $i <= 5; $i++) {
            $result[$i] = $distribution[$i] ?? 0;
        }

        return $result;
    }

    public function getPendingReviews()
    {
        return Review::with(['user', 'product'])
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    public function moderateReview($reviewId, $status)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['status' => $status]);
        return $review;
    }
}
