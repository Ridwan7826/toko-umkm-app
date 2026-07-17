<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        $averageRatings = $this->reviewService->getAverageRatingPerProduct();
        $ratingDistribution = $this->reviewService->getRatingDistribution();
        $pendingReviews = $this->reviewService->getPendingReviews();

        return view('admin.reviews.index', compact('averageRatings', 'ratingDistribution', 'pendingReviews'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $this->reviewService->moderateReview($id, $request->status);

        return redirect()->route('admin.reviews.index')->with('success', 'Status ulasan berhasil diperbarui.');
    }
}
