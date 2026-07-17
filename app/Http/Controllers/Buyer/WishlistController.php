<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected WishlistService $wishlistService;

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index()
    {
        $wishlists = $this->wishlistService->getUserWishlists();
        return view('buyer.wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $this->wishlistService->addProduct($data);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke daftar favorit.');
    }

    public function destroy($id)
    {
        $this->wishlistService->removeProduct($id);

        return redirect()->route('buyer.wishlist.index')->with('success', 'Produk berhasil dihapus dari daftar favorit.');
    }
}
