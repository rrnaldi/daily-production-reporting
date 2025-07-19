<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow d-flex flex-md-row flex-column login-card">
                <div class="col-md-6 left-panel">
                    <div>
                        <h2 class="fw-bold">Selamat Datang</h2>
                        <p class="mt-3">di Aplikasi <strong>Daily Production Reporting</strong></p>
                    </div>
                </div>
                <div class="col-md-6 right-panel">
                    <h4 class="text-center mb-4 fw-semibold">Login</h4>

                    @if ($errors->has('login_error'))
                        <div class="alert alert-danger">{{ $errors->first('login_error') }}</div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
