@extends('pdf.layout')

@section('title', 'Laporan 5 Produk Terlaris')

@section('content')
<div class="summary-box">
    <strong>Berdasarkan Kuantitas Terjual:</strong> Data berikut mengurutkan produk yang paling sering dibeli oleh pelanggan dan telah berstatus Selesai.
</div>

<table>
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Nama Produk (Varian)</th>
            <th>Nomor SKU</th>
            <th class="text-center">Total Unit Terjual</th>
        </tr>
    </thead>
    <tbody>
        @forelse($topProducts as $index => $product)
        <tr>
            <td class="text-center">#{{ $index + 1 }}</td>
            <td><strong>{{ $product['name'] }}</strong></td>
            <td>{{ $product['sku'] ?? 'N/A' }}</td>
            <td class="text-center">{{ $product['total_sold'] }} Unit</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Belum ada data transaksi yang selesai untuk memeringkat produk.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
