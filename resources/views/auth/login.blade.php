@extends('layouts.app')

@section('judul', 'Log In')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="form-auth">
                <h1>Masuk</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <p class="galat">{{ $message }}</p> @enderror

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password') <p class="galat">{{ $message }}</p> @enderror

                    <label class="centang">
                        <input type="checkbox" name="ingat" value="1"> Ingat saya
                    </label>

                    <button type="submit" class="btn-read btn-penuh">Log In</button>
                </form>

                <p class="alihan">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </section>
@endsection