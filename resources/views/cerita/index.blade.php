@extends('layouts.app')

@section('judul', 'Daftar Cerita')

@section('isi')
    @forelse ($ceritas as $cerita)
        <div class="kartu">
            <h3>
                <a href="{{ route('cerita.show', $cerita) }}">{{ $cerita->judul }}</a>
            </h3>
            <span class="badge kategori">{{ $cerita->kategori->nama }}</span>
            @foreach ($cerita->tags as $tag)
                <span class="badge">{{ $tag->nama }}</span>
            @endforeach
            <p>{{ $cerita->deskripsi }}</p>
        </div>
    @empty
        <p>Belum ada cerita.</p>
    @endforelse
@endsection