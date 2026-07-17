@extends('pdf.layout')

@section('title', 'Laporan Estimasi Pendapatan')

@section('content')
<div class="summary-box">
    <strong>Penjelasan Laba Bersih:</strong> Laba Bersih Estimasi dihitung berdasarkan Pendapatan Kotor dikurangi estimasi biaya platform (contoh: 5%). Pendapatan yang sebenarnya ditransfer mungkin memiliki potongan biaya layanan lain dari payment gateway.
</div>

<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th class="text-right">Total Pesanan</th>
            <th class="text-right">Pendapatan Kotor</th>
            <th class="text-right">Laba Bersih (Estimasi)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalGross = 0;
            $totalNet = 0;
        @endphp
        @forelse($monthlyRevenue as $month => $data)
        @php
            $totalGross += $data['gross'];
            $totalNet += $data['estimated_net'];
        @endphp
        <tr>
            <td><strong>{{ $month }}</strong></td>
            <td class="text-right">{{ number_format($data['orders'], 0, ',', '.') }}</td>
            <td class="text-right text-slate-600">Rp {{ number_format($data['gross'], 0, ',', '.') }}</td>
            <td class="text-right font-medium text-green-600">Rp {{ number_format($data['estimated_net'], 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Belum ada rekapan pendapatan bulanan untuk toko ini.</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th>TOTAL KESELURUHAN</th>
            <th class="text-right">-</th>
            <th class="text-right">Rp {{ number_format($totalGross, 0, ',', '.') }}</th>
            <th class="text-right">Rp {{ number_format($totalNet, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>
@endsection
