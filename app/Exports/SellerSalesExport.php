<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SellerSalesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'No. Invoice',
            'Tanggal',
            'Nama Pembeli',
            'Harga Produk',
            'Ongkos Kirim',
            'Total Belanja (IDR)',
            'Status'
        ];
    }

    public function map($order): array
    {
        return [
            $order->invoice_number,
            $order->created_at->format('d/m/Y H:i'),
            $order->user ? $order->user->name : 'N/A',
            $order->total_product_price,
            $order->shipping_cost,
            $order->total_product_price + $order->shipping_cost,
            ucfirst($order->status),
        ];
    }
}
