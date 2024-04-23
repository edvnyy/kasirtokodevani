<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Verifikasi OTP</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('verify.otp') }}">
                            @csrf
                            <div class="form-group">
                                <label for="otp">Masukkan Kode OTP</label>
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"
                                    name="otp" required autofocus>
                                @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
