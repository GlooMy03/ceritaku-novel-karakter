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

                @php $babPertama = $cerita->babs->first(); @endphp
                @if ($babPertama)
                    <div class="tombol-baca">
                        @if ($terakhir && $terakhir->bab)
                            <a href="{{ route('cerita.baca', [$cerita, $terakhir->bab]) }}" class="btn-read tombol-tulis">Lanjutkan Bab {{ $terakhir->bab->nomor }}</a>
                            <a href="{{ route('cerita.baca', [$cerita, $babPertama]) }}" class="btn-garis">Dari awal</a>
                        @else
                            <a href="{{ route('cerita.baca', [$cerita, $babPertama]) }}" class="btn-read tombol-tulis">Mulai Baca</a>
                        @endif
                    </div>
                @endif

                <h3 class="sub-judul">Daftar Bab</h3>
                @forelse ($cerita->babs as $bab)
                    <a href="{{ route('cerita.baca', [$cerita, $bab]) }}" class="baris-bab">
                        <span>Bab {{ $bab->nomor }}: {{ $bab->judul }}</span>
                        <span>Baca →</span>
                    </a>
                @empty
                    <p>Belum ada bab.</p>
                @endforelse

                <p><a href="{{ route('home') }}" class="lihat-semua">← Kembali ke beranda</a></p>
            </div>
        </div>
    </section>
@endsection