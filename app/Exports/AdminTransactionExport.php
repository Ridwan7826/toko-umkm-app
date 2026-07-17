<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AdminTransactionExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        return $this->transactions;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Toko (UMKM)',
            'Pesanan Selesai',
            'Pesanan Dibatalkan',
            'Gross Merchandise Value (GMV/IDR)'
        ];
    }

    public function map($transaction): array
    {
        return [
            date('d/m/Y', strtotime($transaction->date)),
            $transaction->shop->name ?? 'N/A',
            $transaction->completed_orders,
            $transaction->cancelled_orders,
            $transaction->gross_revenue,
        ];
    }
}
