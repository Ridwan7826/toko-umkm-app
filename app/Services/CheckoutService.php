<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutService
{
    /**
     * Calculate shipping cost using RajaOngkir API (Mock).
     */
    public function calculateShipping(array $address, int $weight): ?array
    {
        // Mock RajaOngkir response
        return [
            'courier' => 'JNE',
            'cost' => 15000,
            'service' => 'REG',
            'etd' => '2-3 hari'
        ];
    }

    /**
     * Process checkout, decrement stock, create order, order details, and payment mock.
     */
    public function processCheckout(int $userId, string $courierName = 'JNE'): Order
    {
        return DB::transaction(function () use ($userId, $courierName) {
            $cartItems = Cart::where('user_id', $userId)->with('variant.product')->get();
            
            if ($cartItems->isEmpty()) {
                throw new \Exception('Keranjang belanja kosong.');
            }

            // For simplicity in this scope, we assume all items belong to one shop, or we just group them.
            // Let's get the shop from the first item.
            $firstItem = $cartItems->first();
            $shopId = $firstItem->variant->product->shop_id;

            $totalProductPrice = 0;
            $totalWeight = 0;

            foreach ($cartItems as $item) {
                // Check if items belong to multiple shops
                if ($item->variant->product->shop_id !== $shopId) {
                    throw new \Exception('Checkout harus dilakukan per toko.');
                }
                
                // Check stock
                if ($item->variant->stock < $item->quantity) {
                    throw new \Exception("Stok tidak mencukupi untuk varian: {$item->variant->name}");
                }

                $totalProductPrice += $item->variant->price * $item->quantity;
                $totalWeight += $item->variant->weight * $item->quantity;
            }

            // Get shipping cost (Mock RajaOngkir)
            $shippingMock = $this->calculateShipping([], $totalWeight);
            $shippingCost = $shippingMock['cost'];

            $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            $order = Order::create([
                'user_id' => $userId,
                'shop_id' => $shopId,
                'invoice_number' => $invoiceNumber,
                'total_product_price' => $totalProductPrice,
                'shipping_cost' => $shippingCost,
                'courier_name' => $courierName,
                'status' => 'menunggu_pembayaran',
            ]);

            foreach ($cartItems as $item) {
                $subtotal = $item->variant->price * $item->quantity;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'variant_id' => $item->variant_id,
                    'price' => $item->variant->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $subtotal,
                ]);

                // Decrement stock
                $item->variant->decrement('stock', $item->quantity);
            }

            // Create Payment (Mock Midtrans)
            Payment::create([
                'order_id' => $order->id,
                'snap_token' => 'mock_snap_' . Str::random(10),
                'payment_method' => null,
                'amount' => $totalProductPrice + $shippingCost,
                'status' => 'pending',
            ]);

            // Clear cart
            Cart::where('user_id', $userId)->delete();

            return $order;
        });
    }
}
