<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PublicProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['shop', 'categories', 'reviews.user']);
        return view('public.products.show', compact('product'));
    }
}
