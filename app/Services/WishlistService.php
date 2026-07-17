<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    /**
     * Get all wishlists for the authenticated user.
     */
    public function getUserWishlists()
    {
        return Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    }

    /**
     * Add a product to the user's wishlist.
     */
    public function addProduct(array $data)
    {
        $userId = Auth::id();
        
        // Ensure it doesn't already exist to prevent duplicate entries
        return Wishlist::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $data['product_id'],
        ]);
    }

    /**
     * Remove a product from the user's wishlist.
     */
    public function removeProduct($wishlistId)
    {
        $wishlist = Wishlist::where('id', $wishlistId)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        return $wishlist->delete();
    }
}
