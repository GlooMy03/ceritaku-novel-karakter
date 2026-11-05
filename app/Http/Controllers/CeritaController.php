<?php

namespace App\Http\Controllers;

use App\Models\Bab;
use App\Models\Cerita;
use App\Models\Kategori;
use App\Models\ReadingList;
use App\Models\Tag;
use Illuminate\Http\Request;

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
        $cerita->load(['kategori', 'tags', 'babs' => fn ($q) => $q->orderBy('nomor')]);

        // Bab terakhir yang dibaca akun ini (kalau sudah login)
        $terakhir = auth()->check()
            ? ReadingList::with('bab')
                ->where('user_id', auth()->id())
                ->where('cerita_id', $cerita->id)
                ->first()
            : null;

        return view('cerita.show', compact('cerita', 'terakhir'));
    }

    public function baca(Cerita $cerita, Bab $bab)
    {
        // Tambah jumlah baca tanpa mengubah updated_at
        Cerita::withoutTimestamps(fn () => $cerita->increment('jumlah_baca'));

        // Catat ke Reading List kalau sudah login
        if (auth()->check()) {
            $item = ReadingList::firstOrNew([
                'user_id' => auth()->id(),
                'cerita_id' => $cerita->id,
            ]);
            $item->bab_id = $bab->id;
            $item->save();
            $item->touch();
        }

        $semuaBab = $cerita->babs()->orderBy('nomor')->get();
        $sebelumnya = $semuaBab->where('nomor', '<', $bab->nomor)->last();
        $berikutnya = $semuaBab->where('nomor', '>', $bab->nomor)->first();

        return view('cerita.baca', compact('cerita', 'bab', 'semuaBab', 'sebelumnya', 'berikutnya'));
    }
}