<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $reviews = $this->reviewService->getUserReviews(auth()->id());
        return view('buyer.reviews.index', compact('reviews'));
    }

    public function create(Request $request)
    {
        $data = $this->reviewService->getReviewableOrderAndProduct(
            $request->order_id,
            $request->product_id,
            auth()->id()
        );
        
        return view('buyer.reviews.create', [
            'order' => $data['order'],
            'product' => $data['product'],
        ]);
    }

    public function store(StoreReviewRequest $request)
    {
        $this->reviewService->createReview(auth()->id(), $request->all());

        return redirect()->route('public.products.show', Product::find($request->product_id)->slug)
                         ->with('success', 'Ulasan berhasil ditambahkan!');
    }
}
