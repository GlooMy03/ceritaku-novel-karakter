<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Beranda') | CeritaKu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">Cerita<span>Ku</span></a>

            <div class="menu">
                @foreach ($navKategoris as $k)
                    <a href="{{ route('kategori.show', $k->slug) }}">{{ $k->nama }}</a>
                @endforeach

                <div class="dropdown">
                    <span class="dropdown-tombol" tabindex="0">Genre ▾</span>
                    <div class="dropdown-isi">
                        @foreach ($navTags as $t)
                            <a href="{{ route('genre.show', $t->slug) }}">{{ $t->nama }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <form class="cari" action="{{ route('cerita.index') }}" method="GET">
                <input type="text" name="q" placeholder="Cari judul..." value="{{ request('q') }}">
            </form>

            <div class="auth">
                <a href="#">Log In</a>
                <a href="#" class="btn-garis">Sign Up Now</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('isi')
    </main>

    <footer class="footer">
        <div class="container footer-isi">
            <div>
                <a href="{{ route('home') }}" class="logo">Cerita<span>Ku</span></a>
                <p>Satu tempat untuk novel, manga, manhwa, manhua.</p>
            </div>
            <div>
                <h4>Jelajahi</h4>
                @foreach ($navKategoris as $k)
                    <a href="{{ route('kategori.show', $k->slug) }}">{{ $k->nama }}</a>
                @endforeach
            </div>
            <div>
                <h4>Genre</h4>
                @foreach ($navTags->take(5) as $t)
                    <a href="{{ route('genre.show', $t->slug) }}">{{ $t->nama }}</a>
                @endforeach
            </div>
        </div>
        <div class="container hak-cipta">© {{ date('Y') }} CeritaKu. Semua hak dilindungi.</div>
    </footer>

    @stack('scripts')
</body>
</html>