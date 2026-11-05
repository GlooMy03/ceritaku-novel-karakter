@extends('layouts.app')

@section('judul', 'Pustaka Cerita Saya')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="seksi-kepala">
                <h2>Pustaka Cerita Saya</h2>
                <a href="{{ route('karya.create') }}" class="btn-read tombol-tulis">+ Tulis Cerita</a>
            </div>

            @if (session('sukses'))
                <p class="sukses">{{ session('sukses') }}</p>
            @endif

            @forelse ($ceritas as $cerita)
                <div class="baris-karya">
                    <div>
                        <h3><a href="{{ route('cerita.show', $cerita) }}">{{ $cerita->judul }}</a></h3>
                        <span class="badge kategori">{{ $cerita->kategori->nama }}</span>
                        @foreach ($cerita->tags as $tag)
                            <span class="badge">{{ $tag->nama }}</span>
                        @endforeach
                        <small>{{ number_format($cerita->jumlah_baca, 0, ',', '.') }} dibaca</small>
                    </div>
                    <div class="aksi">
                        <a href="{{ route('karya.edit', $cerita) }}" class="btn-garis">Edit</a>
                        <form action="{{ route('karya.destroy', $cerita) }}" method="POST"
                              onsubmit="return confirm('Hapus cerita ini? Tindakan ini tidak bisa dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Belum ada cerita. Klik "Tulis Cerita" untuk memulai.</p>
            @endforelse
        </div>
    </section>
@endsection