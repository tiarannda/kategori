<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple App</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            font-family: sans-serif;
        }

        .container {
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            max-width: 1000px;
        }

        .left {
            width: 50%;
            background: url("https://images.unsplash.com/photo-1546486808-9692c5c9628e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80") no-repeat center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .left h1 {
            font-size: 3rem;
        }

        .left p {
            font-size: 1.2rem;
            margin-top: 1rem;
        }

        .right {
            width: 50%;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .right h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-primary:hover {
            opacity: 0.8;
        }

        .text-center {
            text-align: center;
        }

        /* Tombol tambahan */
        .btn-link {
            background: none;
            border: none;
            color: #007bff;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: underline;
        }

        .btn-link:hover {
            opacity: 0.8;
        }

        /* Styling untuk gambar */
        .image-container {
            position: absolute;
            top: 0%;
            right: 80%;
            width: 500px;
            height: auto;
        }

        .image-container img {
            width: 100%;
            border-radius: 100px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="left">
            <h1>Welcome Back!</h1>
            <p>Please login to your account.</p>
        </div>
        <div class="right">
            <h2>Login</h2>
            <form method="POST" action="/login">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>

            <!-- Tombol daftar -->
            <div class="text-center" style="margin-top: 1.5rem;">
                <p>Belum punya akun?
                    <a href="{{ route('register') }}" class="btn-link">Daftar</a>
                </p>
            </div>

            <!-- Gambar animasi -->
            <div class="image-container">
                <img src="{{ asset('images/loginfoto.jpg') }}" alt="Login Animation">
            </div>
        </div>
    </div>

</body>
</html>
