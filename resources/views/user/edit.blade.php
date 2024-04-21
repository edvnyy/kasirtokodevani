@extends('layouts.main', ['title' => 'User'])

@section('title-content')
    User
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}" class="card card-cyan card-outline">
                @csrf
                @method('PUT')

                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <x-input name="nama" type="text" value="{{ $user->nama }}" />
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <x-input name="username" type="text" value="{{ $user->username }}" />
                            <div class="form-group">
                                <label>Email</label>
                                <x-input name="email" type="text" value="{{ $user->email }}" />
                    <div class="form-group">
                        <label>Role/Peran</label>
                        <x-select name="role" :options="[['', 'Pilih:'], ['petugas', 'Petugas'], ['admin', 'Administrator']]" :value="$user->role" />
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <x-input name="password" type="password" />
                    </div>

                    <div class="form-group">
                        <label>Password Konfirmasi</label>
                        <x-input name="password_confirmation" type="password" />
                    </div>
                </div>

                <div class="card-footer form-inline">
                    <button type="submit" class="btn btn-outline-primary">Update User</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary ml-auto">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
