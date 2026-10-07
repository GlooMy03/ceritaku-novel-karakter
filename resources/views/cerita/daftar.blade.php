@extends('layouts.app')

@section('judul', $judulHalaman)

@section('isi')
    <section class="seksi">
        <div class="container">
            <div class="seksi-kepala">
                <h2>{{ $judulHalaman }}</h2>
            </div>

            @if ($ceritas->isEmpty())
                <p>Belum ada cerita.</p>
            @else
                <div class="grid">
                    @foreach ($ceritas as $cerita)
                        <x-kartu-cerita :cerita="$cerita" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection