<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\Cerita;

class BabController extends Controller
{
    public function index(Request $request, Cerita $cerita)
    {
        $this->pastikanPemilik($request, $cerita);
        $babs = $cerita->babs()->orderBy('nomor')->get();

        return view('karya.bab.index', compact('cerita', 'babs'));
    }

    public function create(Request $request, Cerita $cerita)
    {
        $this->pastikanPemilik($request, $cerita);

        return view('karya.bab.create', compact('cerita'));
    }

    public function store(Request $request, Cerita $cerita)
    {
        $this->pastikanPemilik($request, $cerita);
        $data = $this->validasi($request);

        $cerita->babs()->create([
            'nomor' => ($cerita->babs()->max('nomor') ?? 0) + 1,
            'judul' => $data['judul'],
            'isi' => Bab::bersihkan($data['isi']),
        ]);

        return redirect()->route('karya.bab.index', $cerita)->with('sukses', 'Bab berhasil ditambahkan.');
    }

    public function edit(Request $request, Cerita $cerita, Bab $bab)
    {
        $this->pastikanPemilik($request, $cerita);

        return view('karya.bab.edit', compact('cerita', 'bab'));
    }

    public function update(Request $request, Cerita $cerita, Bab $bab)
    {
        $this->pastikanPemilik($request, $cerita);
        $data = $this->validasi($request);

        $bab->update([
            'judul' => $data['judul'],
            'isi' => Bab::bersihkan($data['isi']),
        ]);

        return redirect()->route('karya.bab.index', $cerita)->with('sukses', 'Bab berhasil diperbarui.');
    }

    public function destroy(Request $request, Cerita $cerita, Bab $bab)
    {
        $this->pastikanPemilik($request, $cerita);
        $bab->delete();

        return redirect()->route('karya.bab.index', $cerita)->with('sukses', 'Bab berhasil dihapus.');
    }

    // Dipanggil editor saat tombol gambar diklik
    public function unggahGambar(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $path = $request->file('gambar')->store('bab', 'public');

        return response()->json(['url' => '/storage/' . $path]);
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);
    }

    private function pastikanPemilik(Request $request, Cerita $cerita): void
    {
        abort_if($cerita->user_id !== $request->user()->id, 403);
    }
}
