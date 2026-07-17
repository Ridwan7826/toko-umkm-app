<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_filter_products_by_search_category_and_price()
    {
        // Setup User & Shop
        $seller = User::factory()->create();
        $seller->role = 'penjual';
        $seller->save();
        $shop = Shop::create([
            'user_id' => $seller->id,
            'name' => 'Toko Test',
        ]);

        // Setup Categories
        $categoryA = Category::create(['name' => 'Elektronik', 'slug' => 'elektronik']);
        $categoryB = Category::create(['name' => 'Pakaian', 'slug' => 'pakaian']);

        // Setup Products
        // Product 1: Smartphone, Elektronik, price 50000
        $product1 = Product::create([
            'shop_id' => $shop->id,
            'name' => 'Smartphone Canggih',
            'description' => 'Smartphone terbaru',
        ]);
        $product1->categories()->attach($categoryA);
        ProductVariant::create([
            'product_id' => $product1->id,
            'name' => 'Default',
            'sku' => 'SKU-001',
            'price' => 50000,
            'stock' => 10,
            'weight' => 500
        ]);

        // Product 2: Baju Koko, Pakaian, price 100000
        $product2 = Product::create([
            'shop_id' => $shop->id,
            'name' => 'Baju Koko Modern',
            'description' => 'Baju muslim',
        ]);
        $product2->categories()->attach($categoryB);
        ProductVariant::create([
            'product_id' => $product2->id,
            'name' => 'Default',
            'sku' => 'SKU-002',
            'price' => 100000,
            'stock' => 10,
            'weight' => 200
        ]);

        // Product 3: Laptop, Elektronik, price 150000
        $product3 = Product::create([
            'shop_id' => $shop->id,
            'name' => 'Laptop Gaming',
            'description' => 'Laptop spek tinggi',
        ]);
        $product3->categories()->attach($categoryA);
        ProductVariant::create([
            'product_id' => $product3->id,
            'name' => 'Default',
            'sku' => 'SKU-003',
            'price' => 150000,
            'stock' => 5,
            'weight' => 2000
        ]);

        // 1. Test Without Filter
        $response = $this->actingAs($seller)->get(route('seller.products.index'));
        $response->assertStatus(200);
        $response->assertSeeText('Smartphone Canggih');
        $response->assertSeeText('Baju Koko Modern');
        $response->assertSeeText('Laptop Gaming');

        // 2. Test Search by Name
        $response = $this->actingAs($seller)->get(route('seller.products.index', ['search' => 'Laptop']));
        $response->assertSeeText('Laptop Gaming');
        $response->assertDontSeeText('Smartphone Canggih');
        $response->assertDontSeeText('Baju Koko Modern');

        // 3. Test Filter by Category
        $response = $this->actingAs($seller)->get(route('seller.products.index', ['category_id' => $categoryA->id]));
        $response->assertSeeText('Smartphone Canggih');
        $response->assertSeeText('Laptop Gaming');
        $response->assertDontSeeText('Baju Koko Modern');

        // 4. Test Filter by Price Min
        $response = $this->actingAs($seller)->get(route('seller.products.index', ['min_price' => 100000]));
        $response->assertSeeText('Baju Koko Modern');
        $response->assertSeeText('Laptop Gaming');
        $response->assertDontSeeText('Smartphone Canggih');

        // 5. Test Filter by Price Max
        $response = $this->actingAs($seller)->get(route('seller.products.index', ['max_price' => 80000]));
        $response->assertSeeText('Smartphone Canggih');
        $response->assertDontSeeText('Baju Koko Modern');
        $response->assertDontSeeText('Laptop Gaming');

        // 6. Test Combined Filters (Category Elektronik + Price Min 100000)
        $response = $this->actingAs($seller)->get(route('seller.products.index', [
            'category_id' => $categoryA->id,
            'min_price' => 100000
        ]));
        $response->assertSeeText('Laptop Gaming');
        $response->assertDontSeeText('Smartphone Canggih');
        $response->assertDontSeeText('Baju Koko Modern');
    }
}
