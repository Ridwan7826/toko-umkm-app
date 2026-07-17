<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $shop = Auth::user()->shop;
        if (!$shop) abort(404, 'Toko tidak ditemukan.');

        $orders = $this->orderService->getShopOrders($shop->id);
        return view('seller.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $shop = Auth::user()->shop;
        if (!$shop) abort(404, 'Toko tidak ditemukan.');

        $order = $this->orderService->getShopOrderById($id, $shop->id);
        return view('seller.orders.show', compact('order'));
    }

    public function update(Request $request, string $id)
    {
        $shop = Auth::user()->shop;
        if (!$shop) abort(404, 'Toko tidak ditemukan.');

        $request->validate([
            'status' => 'required|in:menunggu_pembayaran,dibayar,diproses,dikirim,selesai,dibatalkan',
            'tracking_number' => 'nullable|string|max:255',
            'courier_name' => 'nullable|string|max:255',
        ]);

        $this->orderService->updateOrderStatus($id, $shop->id, $request->all());

        return redirect()->route('seller.orders.show', $id)->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function printInvoice(string $id)
    {
        $shop = Auth::user()->shop;
        if (!$shop) abort(403);

        $order = $this->orderService->getOrderInvoiceForShop($id, $shop->id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->stream('Invoice_'.$order->invoice_number.'.pdf');
    }
}
