<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShopService;

class ShopController extends Controller
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function index()
    {
        return $this->edit();
    }

    public function edit($id = null)
    {
        $shop = $this->shopService->getShopByUserId(auth()->id());
        if (!$shop) abort(404, 'Toko tidak ditemukan.');
        
        return view('seller.shop.edit', compact('shop'));
    }

    public function update(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'city_id' => 'nullable|integer',
            'logo' => 'nullable|image|max:2048',
        ]);

        $this->shopService->updateShopProfile(auth()->id(), $request->all(), $request->file('logo'));

        return redirect()->route('seller.shop.edit', $id ?? $this->shopService->getShopByUserId(auth()->id())->id)->with('success', 'Profil toko berhasil diperbarui.');
    }
}
