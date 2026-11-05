@extends('layouts.app')

@section('judul', 'Reading List')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="seksi-kepala">
                <h2>Reading List</h2>
            </div>

            @if (session('sukses'))
                <p class="sukses">{{ session('sukses') }}</p>
            @endif

            @forelse ($items as $item)
                <div class="baris-karya">
                    <div>
                        <h3><a href="{{ route('cerita.show', $item->cerita) }}">{{ $item->cerita->judul }}</a></h3>
                        <span class="badge kategori">{{ $item->cerita->kategori->nama }}</span>
                        <small>
                            @if ($item->bab)
                                Terakhir dibaca: Bab {{ $item->bab->nomor }}, {{ $item->bab->judul }}
                            @else
                                Belum ada bab yang bisa dibaca
                            @endif
                        </small>
                    </div>
                    <div class="aksi">
                        @if ($item->bab)
                            <a href="{{ route('cerita.baca', [$item->cerita, $item->bab]) }}" class="btn-read tombol-tulis">Lanjutkan</a>
                        @endif
                        <form action="{{ route('reading-list.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Hapus dari Reading List?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Reading List masih kosong. Buka salah satu bab cerita, maka cerita itu akan masuk di sini.</p>
            @endforelse
        </div>
    </section>
@endsection