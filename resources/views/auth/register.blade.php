@extends('layouts.app')

@section('judul', 'Sign Up')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="form-auth">
                <h1>Buat Akun</h1>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') <p class="galat">{{ $message }}</p> @enderror

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <p class="galat">{{ $message }}</p> @enderror

                    <label for="password">Password (minimal 8 karakter)</label>
                    <input type="password" id="password" name="password" required>
                    @error('password') <p class="galat">{{ $message }}</p> @enderror

                    <label for="password_confirmation">Ulangi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>

                    <button type="submit" class="btn-read btn-penuh">Sign Up</button>
                </form>

                <p class="alihan">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </section>
@endsection