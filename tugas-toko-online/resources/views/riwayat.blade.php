<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #fff;
            color: #000;
        }

        .header {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #eee;
        }

        .btn {
            padding: 4px 10px;
            background: #ddd;
            border: 1px solid #666;
            cursor: pointer;
            text-decoration: none;
            color: black;
            font-size: 13px;
        }

        .order-box {
            border: 1px solid #999;
            padding: 15px;
            margin-bottom: 15px;
            background: #fafafa;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Riwayat Pesanan</h2>
        <a href="{{ route('toko.index') }}" class="btn">&laquo; Kembali ke Toko</a>
    </div>

    @if(session('success'))
    <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
    <div class="order-box">
        <p><b>ID Order:</b> {{ $order->id_order }}</p>
        <p><b>Tanggal:</b> {{ $order->tanggal_order }}</p>
        <p><b>Total Harga:</b> Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
        <p><b>Alamat Pengiriman:</b> {{ $order->alamat_pengiriman }}</p>

        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah Beli</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $detail)
                <tr>
                    <td>{{ $detail->product->nama_barang ?? $detail->id_barang }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah_beli }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @empty
    <p>Belum ada riwayat pesanan.</p>
    @endforelse
</body>

</html>