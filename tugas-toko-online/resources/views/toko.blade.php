<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Toko Online</title>
</head>

<body>
    <h2>Toko Online</h2>
    <p>
        @auth
        Login sebagai: <b>{{ Auth::user()->nama_lengkap ?? Auth::user()->username }}</b> |
        <a href="{{ route('riwayat') }}">Riwayat</a> |
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @else
    <a href="{{ route('login') }}">Login untuk Belanja</a>
    @endauth
    </p>

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
    @endif

    <h3>Daftar Barang</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td align="center">
                    @if($p->gambar)
                    <img src="{{ asset('images/' . $p->gambar) }}" width="80" height="80" style="object-fit: cover;" alt="img">
                    @else
                    -
                    @endif
                </td>
                <td>{{ $p->id_barang }}</td>
                <td>{{ $p->nama_barang }}</td>
                <td>{{ $p->deskripsi }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>{{ $p->stok }}</td>
                <td>
                    @if($p->stok > 0)
                    <form action="{{ route('toko.tambah', $p->id_barang) }}" method="POST">
                        @csrf
                        <button type="submit">Beli</button>
                    </form>
                    @else
                    <span style="color: gray;">Habis</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <!-- Keranjang hanya muncul jika user login-->
    @auth
    @include('keranjang')
    @else
    <p><i>Silakan <a href="{{ route('login') }}">login</a> terlebih dahulu untuk melihat keranjang belanja dan melakukan checkout.</i></p>
    @endauth
</body>

</html>