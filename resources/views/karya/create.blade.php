@extends('layouts.app')

@section('judul', 'Tulis Cerita')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="form-auth form-lebar">
                <h1>Tulis Cerita Baru</h1>
                <form method="POST" action="{{ route('karya.store') }}">
                    @csrf
                    @include('karya._form')
                    <hr class="pemisah">
                    <h2 class="sub-judul">Bab Pertama</h2>

                    <label for="judul_bab">Judul Bab</label>
                    <input type="text" id="judul_bab" name="judul_bab" value="{{ old('judul_bab') }}" placeholder="Contoh: Bab 1 - Awal Mula" required>
                    @error('judul_bab') <p class="galat">{{ $message }}</p> @enderror

                    <label>Isi Bab</label>
                    @include('karya._editor', ['nama' => 'isi_bab', 'nilai' => ''])
                    @error('isi_bab') <p class="galat">{{ $message }}</p> @enderror
                    <button type="submit" class="btn-read btn-penuh">Simpan Cerita</button>
                </form>
                <p class="alihan"><a href="{{ route('karya.index') }}">← Kembali ke pustaka</a></p>
            </div>
        </div>
    </section>
@endsection