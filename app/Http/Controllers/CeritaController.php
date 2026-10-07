<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cerita;
use App\Models\Kategori;
use App\Models\Tag;


class CeritaController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $ceritas = Cerita::with(['kategori', 'tags'])
            ->when($q, fn ($query) => $query->where('judul', 'like', "%{$q}%"))
            ->latest()
            ->get();

        $judulHalaman = $q ? "Hasil pencarian: {$q}" : 'Semua Cerita';

        return view('cerita.daftar', compact('ceritas', 'judulHalaman'));
    }

    public function kategori(Kategori $kategori)
    {
        $ceritas = $kategori->ceritas()->with(['kategori', 'tags'])->latest()->get();
        $judulHalaman = $kategori->nama;

        return view('cerita.daftar', compact('ceritas', 'judulHalaman'));
    }

    public function genre(Tag $tag)
    {
        $ceritas = $tag->ceritas()->with(['kategori', 'tags'])->latest()->get();
        $judulHalaman = 'Genre: ' . $tag->nama;

        return view('cerita.daftar', compact('ceritas', 'judulHalaman'));
    }

    public function show(Cerita $cerita)
    {
        $cerita->load(['kategori', 'tags']);
        return view('cerita.show', compact('cerita'));
    }
}
