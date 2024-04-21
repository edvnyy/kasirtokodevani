<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | Register</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="/"><b>Madu Jaya</b></a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Daftar akun baru</p>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-group mt-3">
                        <input type="text" name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Nama" value="{{ old('nama') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    @error('nama')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="email" name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            placeholder="Username" value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('username')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <div class="input-group-text" id="togglePassword">
                                <span class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <input type="password" name="password_confirmation"
                            class="form-control" placeholder="Confirm Password" id="confirmPassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <div class="input-group-text" id="toggleConfirmPassword">
                                <span class="fas fa-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </div>
                </form>
                <p class="mt-2 mb-1 text-center">
                    <a href="{{ route('login') }}">Sudah punya akun? Masuk</a>
                </p>
            </div>
        </div>
    </div>
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('span').classList.toggle('fa-eye-slash');
        });

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('confirmPassword');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.querySelector('span').classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
