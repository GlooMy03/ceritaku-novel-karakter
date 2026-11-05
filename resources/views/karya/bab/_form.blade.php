<label for="judul">Judul Bab</label>
<input type="text" id="judul" name="judul" value="{{ old('judul', $bab->judul ?? '') }}" placeholder="Contoh: Bab 2 - Pertemuan" required>
@error('judul') <p class="galat">{{ $message }}</p> @enderror

<label>Isi Bab</label>
@include('karya._editor', ['nama' => 'isi', 'nilai' => $bab->isi ?? ''])
@error('isi') <p class="galat">{{ $message }}</p> @enderror