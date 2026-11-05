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
                    <button type="submit" class="btn-read btn-penuh">Simpan Cerita</button>
                </form>
                <p class="alihan"><a href="{{ route('karya.index') }}">← Kembali ke pustaka</a></p>
            </div>
        </div>
    </section>
@endsection