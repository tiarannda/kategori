<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label>Username:</label>
            <input type="username" name="username" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
