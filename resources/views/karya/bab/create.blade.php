@extends('layouts.app')

@section('judul', 'Tambah Bab')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="form-auth form-lebar">
                <h1>Tambah Bab</h1>
                <p class="penulis">{{ $cerita->judul }}</p>
                <form method="POST" action="{{ route('karya.bab.store', $cerita) }}">
                    @csrf
                    @include('karya.bab._form')
                    <button type="submit" class="btn-read btn-penuh">Simpan Bab</button>
                </form>
                <p class="alihan"><a href="{{ route('karya.bab.index', $cerita) }}">← Kembali ke daftar bab</a></p>
            </div>
        </div>
    </section>
@endsection