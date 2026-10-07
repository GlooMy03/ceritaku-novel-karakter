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
                @auth
                    <div class="akun">
                        <button type="button" class="akun-tombol" id="akunTombol" aria-expanded="false">
                            <span class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span class="akun-nama">{{ Auth::user()->name }}</span>
                            <span class="panah">▾</span>
                        </button>

                        <div class="akun-menu" id="akunMenu">
                            <div class="akun-kepala">
                                <span class="avatar besar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <div>
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <small>{{ Auth::user()->email }}</small>
                                </div>
                            </div>

                            <a href="#">Profil Saya</a>
                            <hr>
                            <a href="#">Kotak Masuk</a>
                            <a href="#">Pembaruan <span class="notif">3</span></a>
                            <a href="#">Perpustakaan</a>
                            <hr>
                            <a href="#">Bahasa: Bahasa Indonesia</a>
                            <a href="#">Bantuan</a>
                            <a href="#">Pengaturan</a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="menu-keluar">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}">Log In</a>
                    <a href="{{ route('register') }}" class="btn-garis">Sign Up Now</a>
                @endauth
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
    <script>
        const akunTombol = document.getElementById('akunTombol');
        const akunMenu = document.getElementById('akunMenu');

        if (akunTombol) {
            akunTombol.addEventListener('click', (e) => {
                e.stopPropagation();
                const buka = akunMenu.classList.toggle('buka');
                akunTombol.setAttribute('aria-expanded', buka);
            });

            document.addEventListener('click', (e) => {
                if (!akunMenu.contains(e.target)) {
                    akunMenu.classList.remove('buka');
                    akunTombol.setAttribute('aria-expanded', false);
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>