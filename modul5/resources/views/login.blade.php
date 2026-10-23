<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <p>Masuk untuk membuka dashboard</p>

    @if ($errors->has('login_error'))
    <p><strong>{{ $errors->first('login_error') }}</strong></p>
    @endif

    <form method="POST" action="/login">
        @csrf
        <p>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <button type="submit">Masuk</button>
        </p>
    </form>
</body>

</html>
