<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <h2>Dashboard</h2>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">[ Logout ]</button>
    </form>

    <hr>

    <h3>Selamat datang, {{ $user->nama_lengkap }}!</h3>
    <p>Halaman ini hanya bisa dibuka setelah login.</p>
    <p>Username: {{ $user->username }}</p>
</body>

</html>
