@extends('layouts.app')

@section('judul', $cerita->judul)

@section('isi')
    <section class="seksi">
        <div class="container detail">
            <div class="detail-cover">
                <x-kartu-cerita :cerita="$cerita" />
            </div>
            <div>
                <h1>{{ $cerita->judul }}</h1>
                <p class="penulis">Oleh {{ $cerita->penulis }} · {{ ucfirst($cerita->status) }}</p>

                <div class="tag-baris">
                    <a href="{{ route('kategori.show', $cerita->kategori->slug) }}" class="badge kategori">{{ $cerita->kategori->nama }}</a>
                    @foreach ($cerita->tags as $tag)
                        <a href="{{ route('genre.show', $tag->slug) }}" class="badge">{{ $tag->nama }}</a>
                    @endforeach
                </div>

                <p>{{ $cerita->deskripsi }}</p>
                <a href="{{ route('home') }}" class="lihat-semua">← Kembali ke beranda</a>
            </div>
        </div>
    </section>
@endsection