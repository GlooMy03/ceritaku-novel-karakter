@props(['cerita'])
@php $hue = ($cerita->id * 47) % 360; @endphp

<a href="{{ route('cerita.show', $cerita) }}" class="kartu" data-kategori="{{ $cerita->kategori->slug }}">
    <div class="cover" style="background: linear-gradient(160deg, hsl({{ $hue }}, 70%, 55%), hsl({{ ($hue + 40) % 360 }}, 70%, 28%));">
        @if ($cerita->cover)
            <img src="{{ asset($cerita->cover) }}" alt="{{ $cerita->judul }}">
        @else
            <span>{{ $cerita->judul }}</span>
        @endif
        <span class="lencana">{{ $cerita->kategori->nama }}</span>
    </div>
    <h3>{{ $cerita->judul }}</h3>
    <small>{{ $cerita->penulis }} · {{ number_format($cerita->jumlah_baca, 0, ',', '.') }} dibaca</small>
</a>