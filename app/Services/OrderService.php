<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function getUserOrders($userId)
    {
        return Order::where('user_id', $userId)->latest()->get();
    }

    public function getOrderForUser($orderId, $userId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->user_id !== $userId) {
            abort(403, 'Unauthorized access to this order.');
        }
        return $order->load('details.variant.product');
    }

    public function getOrderInvoiceForUser($orderId, $userId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->user_id !== $userId) {
            abort(403, 'Unauthorized access to this order invoice.');
        }
        return $order->load(['details.variant.product', 'shop', 'user', 'payment']);
    }

    public function getOrderInvoiceForShop($orderId, $shopId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->shop_id !== $shopId) {
            abort(403, 'Unauthorized access to this shop order invoice.');
        }
        return $order->load(['details.variant.product', 'shop', 'user', 'payment']);
    }

    public function getShopOrders($shopId)
    {
        return Order::where('shop_id', $shopId)->with('user')->latest()->get();
    }

    public function getShopOrderById($orderId, $shopId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->shop_id !== $shopId) {
            abort(403, 'Unauthorized access to this order.');
        }
        return $order->load(['details.variant.product', 'user', 'payment']);
    }

    public function updateOrderStatus($orderId, $shopId, array $data)
    {
        $order = Order::findOrFail($orderId);
        if ($order->shop_id !== $shopId) {
            abort(403, 'Unauthorized access to update this order.');
        }

        $newStatus = $data['status'];
        $oldStatus = $order->status;

        // State Machine Validation
        $validTransitions = [
            'menunggu_pembayaran' => ['dibayar', 'dibatalkan'],
            'dibayar' => ['diproses', 'dibatalkan'],
            'diproses' => ['dikirim', 'dibatalkan'],
            'dikirim' => ['selesai', 'dibatalkan'],
            'selesai' => [],
            'dibatalkan' => []
        ];

        if (!in_array($newStatus, $validTransitions[$oldStatus] ?? [])) {
            abort(400, "Transisi status dari '{$oldStatus}' ke '{$newStatus}' tidak diizinkan.");
        }

        $order->update([
            'status' => $newStatus,
            'tracking_number' => $data['tracking_number'] ?? $order->tracking_number,
            'courier_name' => $data['courier_name'] ?? $order->courier_name,
        ]);

        return $order;
    }
}
