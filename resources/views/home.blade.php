@extends('layouts.app')

@section('judul', 'Beranda')

@section('isi')
    {{-- HERO --}}
    <section class="hero">
        <div class="container">
            <div>
                <h1>Datang untuk <em>cerita</em>. Betah karena serunya.</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <button type="button" class="btn-read">Read</button>
            </div>

            <div class="ilustrasi">
                <div class="blob b1"></div>
                <div class="blob b2"></div>
                <div class="buku k1">Fantasi</div>
                <div class="buku k2">Romance</div>
                <div class="buku k3">Aksi</div>
                <span class="chip c1">Lorem ipsum dolor</span>
                <span class="chip c2">Sit amet elit</span>
            </div>
        </div>
    </section>

    {{-- LAGI TREN --}}
    <section class="seksi" id="trending">
        <div class="container">
            <div class="seksi-kepala">
                <h2>LAGI TREN SEKARANG</h2>
                <div class="tabs">
                    <button type="button" class="tab aktif" data-filter="semua">Semua</button>
                    @foreach ($rakKategori as $k)
                        <button type="button" class="tab" data-filter="{{ $k->slug }}">{{ $k->nama }}</button>
                    @endforeach
                </div>
            </div>

            <div class="rak">
                @foreach ($trending as $cerita)
                    <x-kartu-cerita :cerita="$cerita" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- RAK PER KATEGORI --}}
    @foreach ($rakKategori as $kategori)
        @if ($kategori->ceritas->isNotEmpty())
            <section class="seksi">
                <div class="container">
                    <div class="seksi-kepala">
                        <h2 class="judul-rak">{{ $kategori->nama }}</h2>
                        <a href="{{ route('kategori.show', $kategori->slug) }}" class="lihat-semua">Lihat semua →</a>
                    </div>
                    <div class="rak rak-kategori">
                        @foreach ($kategori->ceritas as $cerita)
                            <x-kartu-cerita :cerita="$cerita" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    {{-- AJAKAN BERGABUNG --}}
    <section class="seksi">
        <div class="container">
            <div class="cta">
                <h2>Mulai membaca dan simpan koleksimu</h2>
                <p>Daftar gratis untuk menyimpan cerita favorit dan mendapat update terbaru.</p>
                <a href="#" class="btn-putih">Sign Up Now</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    const tabs = document.querySelectorAll('#trending .tab');
    const kartus = document.querySelectorAll('#trending .kartu');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('aktif'));
            tab.classList.add('aktif');

            const filter = tab.dataset.filter;
            kartus.forEach(kartu => {
                kartu.style.display = (filter === 'semua' || kartu.dataset.kategori === filter) ? '' : 'none';
            });
        });
    });
</script>
@endpush