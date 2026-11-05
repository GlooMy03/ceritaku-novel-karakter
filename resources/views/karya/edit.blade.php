@extends('layouts.app')

@section('judul', 'Edit Cerita')

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="form-auth form-lebar">
                <h1>Edit Cerita</h1>

                @if (session('sukses'))
                    <p class="sukses">{{ session('sukses') }}</p>
                @endif

                <form method="POST" action="{{ route('karya.update', $cerita) }}">
                    @csrf
                    @method('PUT')
                    @include('karya._form')
                    <button type="submit" class="btn-read btn-penuh">Simpan Perubahan</button>
                </form>

                <hr class="pemisah">

                <div class="seksi-kepala">
                    <h2 class="sub-judul">Bab</h2>
                    <a href="{{ route('karya.bab.create', $cerita) }}" class="btn-garis">+ Tambah Bab</a>
                </div>

                @forelse ($cerita->babs as $bab)
                    <div class="baris-karya">
                        <div>
                            <strong>Bab {{ $bab->nomor }}: {{ $bab->judul }}</strong>
                        </div>
                        <div class="aksi">
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
        </div>
    </section>
@endsection