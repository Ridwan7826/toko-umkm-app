<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getUserOrders(auth()->id());
        return view('buyer.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderForUser($id, auth()->id());
        return view('buyer.orders.show', compact('order'));
    }

    public function printInvoice($id)
    {
        $order = $this->orderService->getOrderInvoiceForUser($id, auth()->id());
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->stream('Invoice_'.$order->invoice_number.'.pdf');
    }
}
