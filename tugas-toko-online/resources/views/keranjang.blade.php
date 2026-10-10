<h3>Keranjang Belanja</h3>
@if(!empty($cart) && count($cart) > 0)
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $id => $details)
        @php
        $subtotal = $details['harga'] * $details['quantity'];
        $total += $subtotal;
        @endphp
        <tr>
            <td>{{ $details['nama_barang'] }}</td>
            <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
            <td>
                {{ $details['quantity'] }}
                <form action="{{ route('toko.kurang', $id) }}" method="POST" style="display:inline;">@csrf <button>-</button></form>
                <form action="{{ route('toko.tambah', $id) }}" method="POST" style="display:inline;">@csrf <button>+</button></form>
            </td>
            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('toko.hapus', $id) }}" method="POST">
                    @csrf
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" align="right"><b>Total Bayar:</b></td>
            <td colspan="2"><b>Rp {{ number_format($total, 0, ',', '.') }}</b></td>
        </tr>
    </tbody>
</table>
<br>
<form action="{{ route('toko.checkout') }}" method="POST">
    @csrf
    <button type="submit">Checkout Sekarang</button>
</form>
@else
<p>Keranjang belanja masih kosong.</p>
@endif