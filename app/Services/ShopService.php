<?php

namespace App\Services;

use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class ShopService
{
    public function getShopByUserId($userId)
    {
        return Shop::where('user_id', $userId)->first();
    }

    public function updateShopProfile($userId, array $data, $logoFile = null)
    {
        $shop = Shop::where('user_id', $userId)->firstOrFail();

        $logoPath = $shop->logo;
        if ($logoFile) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $logoFile->store('shops', 'public');
        }

        $shop->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'address' => $data['address'] ?? null,
            'city_id' => $data['city_id'] ?? null,
            'logo' => $logoPath,
        ]);

        return $shop;
    }
}
