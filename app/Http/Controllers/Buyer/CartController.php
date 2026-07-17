<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $carts = $this->cartService->getUserCart(auth()->id());
        return view('buyer.cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $this->cartService->addToCart(auth()->id(), $request->all());

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartService->updateCartQuantity(auth()->id(), $id, $request->quantity);

        return redirect()->route('buyer.cart.index')->with('success', 'Kuantitas berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $this->cartService->removeFromCart(auth()->id(), $id);
        return redirect()->route('buyer.cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}
