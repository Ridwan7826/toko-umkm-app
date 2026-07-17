<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getShopProducts($shopId, $filters = [], $perPage = 10)
    {
        $query = Product::with(['categories', 'variants'])->where('shop_id', $shopId);

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['category_id'])) {
            $query->filterCategory($filters['category_id']);
        }

        if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
            $query->filterPrice($filters['min_price'] ?? null, $filters['max_price'] ?? null);
        }

        return $query->latest()->paginate($perPage);
    }

    public function getShopProductById($shopId, $productId)
    {
        return Product::with(['categories', 'variants'])->where('shop_id', $shopId)->findOrFail($productId);
    }

    public function createProduct($shopId, array $data, $imageFile = null)
    {
        DB::beginTransaction();
        try {
            $imagePath = null;
            if ($imageFile) {
                $imagePath = $imageFile->store('products', 'public');
            }

            $product = Product::create([
                'shop_id' => $shopId,
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'image' => $imagePath,
            ]);

            if (isset($data['category_ids'])) {
                $product->categories()->attach($data['category_ids']);
            }

            if (isset($data['variants']) && is_array($data['variants'])) {
                foreach ($data['variants'] as $variantData) {
                    $product->variants()->create([
                        'name' => $variantData['name'],
                        'sku' => $variantData['sku'] ?? null,
                        'price' => $variantData['price'],
                        'weight' => $variantData['weight'],
                        'stock' => $variantData['stock'],
                    ]);
                }
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct($shopId, $productId, array $data, $imageFile = null)
    {
        $product = Product::where('shop_id', $shopId)->findOrFail($productId);

        DB::beginTransaction();
        try {
            $imagePath = $product->image;
            if ($imageFile) {
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $imageFile->store('products', 'public');
            }

            $product->update([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'image' => $imagePath,
            ]);

            if (isset($data['category_ids'])) {
                $product->categories()->sync($data['category_ids']);
            }

            if (isset($data['variants']) && is_array($data['variants'])) {
                $existingVariantIds = $product->variants()->pluck('id')->toArray();
                $updatedVariantIds = [];

                foreach ($data['variants'] as $variantData) {
                    if (isset($variantData['id']) && in_array($variantData['id'], $existingVariantIds)) {
                        // Update existing
                        $product->variants()->where('id', $variantData['id'])->update([
                            'name' => $variantData['name'],
                            'sku' => $variantData['sku'] ?? null,
                            'price' => $variantData['price'],
                            'weight' => $variantData['weight'],
                            'stock' => $variantData['stock'],
                        ]);
                        $updatedVariantIds[] = $variantData['id'];
                    } else {
                        // Create new
                        $newVariant = $product->variants()->create([
                            'name' => $variantData['name'],
                            'sku' => $variantData['sku'] ?? null,
                            'price' => $variantData['price'],
                            'weight' => $variantData['weight'],
                            'stock' => $variantData['stock'],
                        ]);
                        $updatedVariantIds[] = $newVariant->id;
                    }
                }

                // Delete variants that were removed
                $variantsToDelete = array_diff($existingVariantIds, $updatedVariantIds);
                if (!empty($variantsToDelete)) {
                    $product->variants()->whereIn('id', $variantsToDelete)->delete();
                }
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteProduct($shopId, $productId)
    {
        $product = Product::where('shop_id', $shopId)->findOrFail($productId);

        DB::beginTransaction();
        try {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->variants()->delete();
            $product->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
