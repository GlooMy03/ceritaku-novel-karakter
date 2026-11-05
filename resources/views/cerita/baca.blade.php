@extends('layouts.app')

@section('judul', $bab->judul . ' - ' . $cerita->judul)

@section('isi')
    <div class="progres"><div id="progresBar"></div></div>

    <section class="seksi">
        <div class="container baca">
            <div class="baca-atas">
                <a href="{{ route('cerita.show', $cerita) }}" class="lihat-semua">← {{ $cerita->judul }}</a>

                <div class="baca-alat">
                    <select id="pilihBab" onchange="window.location = this.value">
                        @foreach ($semuaBab as $b)
                            <option value="{{ route('cerita.baca', [$cerita, $b]) }}" @selected($b->id === $bab->id)>
                                Bab {{ $b->nomor }}: {{ $b->judul }}
                            </option>
                        @endforeach
                    </select>
                    <button type="button" id="huruf-kecil" class="tombol-huruf">A−</button>
                    <button type="button" id="huruf-besar" class="tombol-huruf">A+</button>
                </div>
            </div>

            <h1>Bab {{ $bab->nomor }}: {{ $bab->judul }}</h1>

            <article class="isi-bab" id="isiBab">
                {!! $bab->isi !!}
            </article>

            <div class="nav-bab">
                @if ($sebelumnya)
                    <a href="{{ route('cerita.baca', [$cerita, $sebelumnya]) }}" class="btn-garis">← Sebelumnya</a>
                @else
                    <span></span>
                @endif

                @if ($berikutnya)
                    <a href="{{ route('cerita.baca', [$cerita, $berikutnya]) }}" class="btn-read tombol-tulis">Berikutnya →</a>
                @else
                    <a href="{{ route('cerita.show', $cerita) }}" class="btn-garis">Selesai, kembali ke cerita</a>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Bilah progres membaca
    const bar = document.getElementById('progresBar');
    window.addEventListener('scroll', () => {
        const tinggi = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (tinggi > 0 ? (window.scrollY / tinggi) * 100 : 0) + '%';
    });

    // Ukuran huruf, diingat di browser
    const isi = document.getElementById('isiBab');
    let ukuran = 18;
    try { ukuran = parseInt(localStorage.getItem('ukuranHuruf')) || 18; } catch (e) {}
    isi.style.fontSize = ukuran + 'px';

    function ubahUkuran(delta) {
        ukuran = Math.min(28, Math.max(14, ukuran + delta));
        isi.style.fontSize = ukuran + 'px';
        try { localStorage.setItem('ukuranHuruf', ukuran); } catch (e) {}
    }
    document.getElementById('huruf-kecil').addEventListener('click', () => ubahUkuran(-2));
    document.getElementById('huruf-besar').addEventListener('click', () => ubahUkuran(2));
</script>
@endpush