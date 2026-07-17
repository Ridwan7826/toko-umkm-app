<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\CheckoutService;

use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    protected CheckoutService $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function index()
    {
        return view('buyer.checkout.index');
    }

    public function getOngkir(Request $request)
    {
        // Example integration
        $cost = $this->checkoutService->calculateShipping(
            $request->input('address', []),
            $request->input('weight', 1000)
        );

        return response()->json($cost);
    }

    public function process(CheckoutRequest $request)
    {
        try {
            $order = $this->checkoutService->processCheckout(
                auth()->id(),
                $request->input('courier', 'JNE')
            );
            return redirect()->route('buyer.orders.show', $order->id)->with('success', 'Berhasil checkout! Silakan selesaikan pembayaran.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
