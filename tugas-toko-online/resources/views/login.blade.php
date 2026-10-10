<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

    <h2>Login Toko Online</h2>

    @if($errors->any())
    <div>
        <p style="color: red;">{{ $errors->first() }}</p>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>
        <br>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>

</body>

</html>