@extends('pdf.layout')

@section('title', 'Laporan Penjualan Harian')

@section('content')
<div class="summary-box">
    <strong>Total Pendapatan (Gross):</strong> Rp {{ number_format($totalRevenue, 0, ',', '.') }}<br>
    <strong>Total Pesanan Selesai:</strong> {{ number_format($totalOrders, 0, ',', '.') }} pesanan
</div>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th class="text-right">Total Pesanan</th>
            <th class="text-right">Pesanan Selesai</th>
            <th class="text-right">Pesanan Batal</th>
            <th class="text-right">Pendapatan Kotor</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dailySales as $index => $sale)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ date('d F Y', strtotime($sale->date)) }}</td>
            <td class="text-right">{{ $sale->total_orders }}</td>
            <td class="text-right">{{ $sale->completed_orders }}</td>
            <td class="text-right">{{ $sale->cancelled_orders }}</td>
            <td class="text-right">Rp {{ number_format($sale->gross_revenue, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data penjualan harian untuk rentang waktu ini.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
