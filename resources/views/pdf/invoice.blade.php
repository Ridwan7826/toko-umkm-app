@extends('pdf.layout')

@section('title', 'Invoice Pembelian')

@section('content')
<div style="margin-bottom: 20px;">
    <strong>Invoice:</strong> {{ $order->invoice_number }}<br>
    <strong>Status:</strong> {{ strtoupper(str_replace('_', ' ', $order->status)) }}<br>
    <strong>Metode Pembayaran:</strong> {{ $order->payment ? $order->payment->payment_type : 'Belum tersedia' }}
</div>

<div style="margin-bottom: 20px;">
    <div style="float: left; width: 48%;">
        <strong>Informasi Pembeli:</strong>
        <p style="margin: 5px 0;">
            {{ $order->user->name }}<br>
            {{ $order->user->email }}<br>
            {{ $order->user->phone ?? 'Telepon belum diatur' }}
        </p>
    </div>
    <div style="float: right; width: 48%;">
        <strong>Informasi Pengiriman:</strong>
        <p style="margin: 5px 0;">
            Kurir: {{ $order->courier_name ?? 'Belum ditentukan' }}<br>
            Resi: {{ $order->tracking_number ?? 'Belum ada resi' }}<br>
        </p>
    </div>
    <div class="clear"></div>
</div>

<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Item Produk</th>
            <th class="text-center">Kuantitas</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->details as $index => $detail)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                <strong>{{ $detail->variant->product->name }}</strong><br>
                <span style="font-size: 11px; color: #666;">Varian: {{ $detail->variant->name }} (SKU: {{ $detail->variant->sku }})</span>
            </td>
            <td class="text-center">{{ $detail->quantity }}</td>
            <td class="text-right">Rp {{ number_format($detail->price_per_unit, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($detail->price_per_unit * $detail->quantity, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="float: right; width: 40%;">
    <table style="border: none;">
        <tr>
            <td style="border: none; text-align: right; padding: 5px;">Total Harga Produk:</td>
            <td style="border: none; text-align: right; padding: 5px;">Rp {{ number_format($order->total_product_price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="border: none; text-align: right; padding: 5px;">Ongkos Kirim:</td>
            <td style="border: none; text-align: right; padding: 5px;">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="border: none; text-align: right; padding: 5px;"><strong>Total Tagihan:</strong></td>
            <td style="border: none; text-align: right; padding: 5px;"><strong>Rp {{ number_format($order->total_product_price + $order->shipping_cost, 0, ',', '.') }}</strong></td>
        </tr>
    </table>
</div>
<div class="clear"></div>
@endsection
