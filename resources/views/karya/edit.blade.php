@extends('layouts.app')

@section('judul', 'Edit Cerita')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="form-auth form-lebar">
                <h1>Edit Cerita</h1>
                <form method="POST" action="{{ route('karya.update', $cerita) }}">
                    @csrf
                    @method('PUT')
                    @include('karya._form')
                    <button type="submit" class="btn-read btn-penuh">Simpan Perubahan</button>
                </form>
                <p class="alihan"><a href="{{ route('karya.index') }}">← Kembali ke pustaka</a></p>
            </div>
        </div>
    </section>
@endsection