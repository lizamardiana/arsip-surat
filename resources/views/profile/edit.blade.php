@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- 🔹 Update Profile -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Update Profile Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" 
                                class="form-control" 
                                value="{{ old('name', auth()->user()->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" id="email" 
                                class="form-control" 
                                value="{{ old('email', auth()->user()->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

            <!-- 🔒 Update Password -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Ubah Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Sekarang</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning px-4">Ubah Password</button>
                    </form>
                </div>
            </div>

            <!-- 🗑️ Delete Account -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Hapus Akun</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <p class="text-muted">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus permanen.</p>
                        <button type="submit" class="btn btn-danger px-4">Hapus Akun</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
