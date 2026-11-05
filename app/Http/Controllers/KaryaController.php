<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cerita;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\Bab;

class KaryaController extends Controller
{
    // READ: pustaka cerita milik akun yang login
    public function index(Request $request)
    {
        $ceritas = $request->user()->ceritas()
            ->with(['kategori', 'tags'])
            ->withCount('babs')
            ->latest()
            ->get();

        return view('karya.index', compact('ceritas'));
    }

    // CREATE: tampilkan form
    public function create()
    {
        return view('karya.create', [
            'kategoris' => Kategori::orderBy('id')->get(),
            'tags' => Tag::orderBy('nama')->get(),
        ]);
    }

    // CREATE: simpan cerita beserta bab pertama
    public function store(Request $request)
    {
        $data = $this->validasi($request);
        $bab = $request->validate([
            'judul_bab' => 'required|string|max:255',
            'isi_bab' => 'required|string',
        ]);

        $cerita = $request->user()->ceritas()->create([
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'kategori_id' => $data['kategori_id'],
            'penulis' => $request->user()->name,
        ]);

        $cerita->tags()->sync($data['tags'] ?? []);

        $cerita->babs()->create([
            'nomor' => 1,
            'judul' => $bab['judul_bab'],
            'isi' => Bab::bersihkan($bab['isi_bab']),
        ]);

        return redirect()->route('karya.index')->with('sukses', 'Cerita berhasil ditambahkan.');
    }

    // UPDATE: tampilkan form edit
    public function edit(Request $request, Cerita $cerita)
    {
        $this->pastikanPemilik($request, $cerita);
        $cerita->load(['tags', 'babs' => fn ($q) => $q->orderBy('nomor')]);

        return view('karya.edit', [
            'cerita' => $cerita,
            'kategoris' => Kategori::orderBy('id')->get(),
            'tags' => Tag::orderBy('nama')->get(),
        ]);
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, Cerita $cerita)
    {
        $this->pastikanPemilik($request, $cerita);
        $data = $this->validasi($request);

        $cerita->update([
            'judul' => $data['judul'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'kategori_id' => $data['kategori_id'],
        ]);

        $cerita->tags()->sync($data['tags'] ?? []);

        return redirect()->route('karya.index')->with('sukses', 'Cerita berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Request $request, Cerita $cerita)
    {
        $this->pastikanPemilik($request, $cerita);
        $cerita->delete();

        return redirect()->route('karya.index')->with('sukses', 'Cerita berhasil dihapus.');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:2000',
            'kategori_id' => 'required|exists:kategoris,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);
    }

    // Hanya pemilik yang boleh mengubah atau menghapus
    private function pastikanPemilik(Request $request, Cerita $cerita): void
    {
        abort_if($cerita->user_id !== $request->user()->id, 403);
    }
}
