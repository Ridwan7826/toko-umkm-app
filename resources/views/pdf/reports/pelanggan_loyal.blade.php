@extends('pdf.layout')

@section('title', 'Laporan 10 Pelanggan Loyal')

@section('content')
<div class="summary-box">
    <strong>Daftar Top Spender:</strong> Data berikut menampilkan 10 pembeli teratas yang memiliki total pembelanjaan (termasuk ongkir) tertinggi di toko Anda pada pesanan yang telah selesai.
</div>

<table>
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th class="text-center">Total Pesanan</th>
            <th class="text-right">Total Belanja (Spent)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($topCustomers as $index => $customer)
        <tr>
            <td class="text-center">#{{ $index + 1 }}</td>
            <td><strong>{{ $customer->user->name }}</strong></td>
            <td>{{ $customer->user->email }}</td>
            <td class="text-center">{{ $customer->total_orders }} x</td>
            <td class="text-right">Rp {{ number_format($customer->total_spent, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada pelanggan dengan pesanan berstatus Selesai.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
