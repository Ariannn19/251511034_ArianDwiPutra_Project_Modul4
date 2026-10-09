<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
</head>

<body>
    <h2>Daftar Produk</h2>

    @if (session('success'))
    <p><strong>{{ session('success') }}</strong></p>
    @endif

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarBarang as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->nama }}</td>
                <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                <td>{{ $b->stok }}</td>
                <td>
                    <form method="POST" action="{{ route('keranjang.tambah', $b->id) }}">
                        @csrf
                        <button type="submit">+ Ke Keranjang</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <h2>Isi Keranjang Belanja</h2>

    @if (count($itemsKeranjang) > 0)
    <table border="1" cellpadding="6" cellspacing="0">
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
            @foreach ($itemsKeranjang as $item)
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td>
                    <form method="POST" action="{{ route('keranjang.kurangQty', $item['id']) }}" style="display:inline;">
                        @csrf
                        <button type="submit">-</button>
                    </form>

                    <strong> {{ $item['jumlah'] }} </strong>

                    <form method="POST" action="{{ route('keranjang.tambahQty', $item['id']) }}" style="display:inline;">
                        @csrf
                        <button type="submit">+</button>
                    </form>
                </td>
                <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                <td>
                    <form method="POST" action="{{ route('keranjang.hapus', $item['id']) }}">
                        @csrf
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total Belanja: Rp {{ number_format($totalHarga, 0, ',', '.') }}</h3>

    <form method="POST" action="{{ route('keranjang.kosongkan') }}">
        @csrf
        <button type="submit">Kosongkan Keranjang</button>
    </form>
    @else
    <p>Keranjang belanja masih kosong.</p>
    @endif
</body>

</html>