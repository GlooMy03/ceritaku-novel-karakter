@extends('layouts.app')

@section('judul', 'Bab: ' . $cerita->judul)

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="seksi-kepala">
                <h2>Bab: {{ $cerita->judul }}</h2>
                <a href="{{ route('karya.bab.create', $cerita) }}" class="btn-read tombol-tulis">+ Tambah Bab</a>
            </div>

            @if (session('sukses'))
                <p class="sukses">{{ session('sukses') }}</p>
            @endif

            @forelse ($babs as $bab)
                <div class="baris-karya">
                    <div>
                        <h3>Bab {{ $bab->nomor }}: {{ $bab->judul }}</h3>
                        <small>Diperbarui {{ $bab->updated_at->diffForHumans() }}</small>
                    </div>
                    <div class="aksi">
                        <a href="{{ route('cerita.baca', [$cerita, $bab]) }}" class="btn-garis">Baca</a>
                        <a href="{{ route('karya.bab.edit', [$cerita, $bab]) }}" class="btn-garis">Edit</a>
                        <form action="{{ route('karya.bab.destroy', [$cerita, $bab]) }}" method="POST"
                              onsubmit="return confirm('Hapus bab ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Belum ada bab.</p>
            @endforelse

            <p class="alihan"><a href="{{ route('karya.index') }}">← Kembali ke pustaka</a></p>
        </div>
    </section>
@endsection