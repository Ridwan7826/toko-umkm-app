<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getUserCart($userId)
    {
        return Cart::where('user_id', $userId)
            ->with(['variant.product'])
            ->latest()
            ->get();
    }

    public function addToCart($userId, array $data)
    {
        $existingCart = Cart::where('user_id', $userId)
            ->where('variant_id', $data['variant_id'])
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $data['quantity'] ?? 1);
            return $existingCart;
        }

        return Cart::create([
            'user_id' => $userId,
            'variant_id' => $data['variant_id'],
            'quantity' => $data['quantity'] ?? 1,
        ]);
    }

    public function updateCartQuantity($userId, $cartId, $quantity)
    {
        $cart = Cart::where('user_id', $userId)->findOrFail($cartId);
        $cart->update(['quantity' => $quantity]);
        return $cart;
    }

    public function removeFromCart($userId, $cartId)
    {
        return Cart::where('user_id', $userId)->where('id', $cartId)->delete();
    }
}
