@php
    $dipilih = old('tags', isset($cerita) ? $cerita->tags->pluck('id')->all() : []);
@endphp

<label for="judul">Judul</label>
<input type="text" id="judul" name="judul" value="{{ old('judul', $cerita->judul ?? '') }}" required>
@error('judul') <p class="galat">{{ $message }}</p> @enderror

<label for="deskripsi">Deskripsi</label>
<textarea id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $cerita->deskripsi ?? '') }}</textarea>
@error('deskripsi') <p class="galat">{{ $message }}</p> @enderror

<label for="kategori_id">Kategori</label>
<select id="kategori_id" name="kategori_id" required>
    <option value="">Pilih kategori</option>
    @foreach ($kategoris as $k)
        <option value="{{ $k->id }}" @selected(old('kategori_id', $cerita->kategori_id ?? '') == $k->id)>{{ $k->nama }}</option>
    @endforeach
</select>
@error('kategori_id') <p class="galat">{{ $message }}</p> @enderror

<label>Tag / Genre</label>
<div class="tag-pilih">
    @foreach ($tags as $t)
        <label class="centang">
            <input type="checkbox" name="tags[]" value="{{ $t->id }}" @checked(in_array($t->id, $dipilih))>
            {{ $t->nama }}
        </label>
    @endforeach
</div>
@error('tags.*') <p class="galat">{{ $message }}</p> @enderror