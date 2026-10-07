<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cerita;
use App\Models\Tag;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        $trending = Cerita::with('kategori')->orderByDesc('jumlah_baca')->take(20)->get();

        // Satu rak per kategori (Manga, Manhwa, Manhua, Novel), maksimal 15 cerita per rak
        $rakKategori = Kategori::orderBy('id')->get()->each(function ($kategori) {
            $kategori->setRelation(
                'ceritas',
                $kategori->ceritas()->with('kategori')->latest()->take(15)->get()
            );
        });

        $terbaru = Cerita::with('kategori')->latest('updated_at')->take(12)->get();

        return view('home', compact('trending', 'rakKategori', 'terbaru'));
    }
}
