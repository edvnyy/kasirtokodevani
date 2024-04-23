<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Madu Jaya</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>
                @if (session('store') == 'success')
                    <div class="alert alert-success">
                        <strong>Berhasil dibuat!</strong> Akun berhasil dibuat. Silakan login.
                    </div>
                @endif
                @if (session('password_reset_success'))
                    <div class="alert alert-success">
                        {{ session('password_reset_success') }}
                    </div>
                @endif
                @if (session('otp_success'))
                    <div class="alert alert-success">
                        {{ session('otp_success') }}
                    </div>
                @endif


                <form action="/login" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="login" class="form-control @error('login') is-invalid @enderror"
                            placeholder="Email atau Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('login')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <div class="input-group-text">
                                <span class="fas fa-eye" id="togglePassword"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="d-block invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="row mt-3">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    Ingatkan Saya
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
                <p class="mt-2 mb-1 text-center">
                    <a href="{{ route('register') }}" style="color: black">Belum punya akun? <b
                            class="text-blue">Daftar</b></a>
                </p>
                <p class="mt-2 mb-1 text-center">
                    <a href="{{ route('password.request') }}" style="color: red"><b>Lupa password?</b></a>
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
            this.classList.toggle('fa-eye-slash');
        });

        const rememberCheckbox = document.getElementById('remember');
        const storedPassword = localStorage.getItem('remembered_password');

        if (rememberCheckbox.checked && storedPassword) {
            password.value = storedPassword;
        }

        rememberCheckbox.addEventListener('change', function() {
            if (this.checked && storedPassword) {
                password.value = storedPassword;
            }
        });

        password.addEventListener('input', function() {
            if (rememberCheckbox.checked) {
                localStorage.setItem('remembered_password', this.value);
            }
        });
    </script>

</body>

</html>
