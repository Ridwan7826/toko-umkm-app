<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SellerLowStockExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Nama Produk',
            'Varian',
            'Harga (IDR)',
            'Sisa Stok'
        ];
    }

    public function map($variant): array
    {
        return [
            $variant->sku,
            $variant->product->name,
            $variant->name,
            $variant->price,
            $variant->stock,
        ];
    }
}
