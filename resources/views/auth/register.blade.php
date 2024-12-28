<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            background: url("https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80") no-repeat center/cover;
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
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input, select {
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
            <h1>Join Us!</h1>
            <p>Create your account to get started.</p>
        </div>
        <div class="right">
            <h2>Register</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
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
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="karyawan">Karyawan</option>
                    </select>
                </div>
                <button type="submit" class="btn-primary">Daftar</button>
            </form>

            <!-- Gambar animasi -->
            <div class="image-container">
                <img src="{{ asset('images/animasi_register.png') }}" alt="Register Animation">
            </div>
        </div>
    </div>

</body>
</html>
