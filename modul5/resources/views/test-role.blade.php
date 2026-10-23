<!DOCTYPE html>
<html>

<head>
    <title>Test Ubah Role</title>
</head>

<body>
    <h2>Form Ubah Role</h2>

    @if(session('status'))
    <p style="color: green; font-weight: bold;">{{ session('status') }}</p>
    @endif

    @if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/admin/users/1/role" method="POST">
        @csrf
        @method('PATCH')

        <label>Pilih Role Baru:</label>
        <select name="role">
            <option value="customer">Customer</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Ubah Role</button>
    </form>

    <hr>
    <h2>Simulasi Keranjang Belanja</h2>
    <form action="/cart/add" method="POST">
        @csrf
        <button type="submit">Tambah Barang ke Keranjang</button>
    </form>
</body>

</html>