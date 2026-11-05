<div class="editor-bungkus">
    <div id="editor">{!! \App\Models\Bab::bersihkan(old($nama, $nilai)) !!}</div>
</div>
<input type="hidden" name="{{ $nama }}" id="isiInput">

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Tulis isi bab di sini...',
        modules: {
            toolbar: {
                container: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ],
                handlers: { image: pilihGambar }
            }
        }
    });

    function pilihGambar() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/png,image/jpeg,image/webp,image/gif';
        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;
            const data = new FormData();
            data.append('gambar', file);
            try {
                const res = await fetch('{{ route('karya.gambar') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: data
                });
                if (!res.ok) throw new Error();
                const { url } = await res.json();
                const posisi = quill.getSelection(true);
                quill.insertEmbed(posisi.index, 'image', url);
                quill.setSelection(posisi.index + 1);
            } catch (e) {
                alert('Gambar gagal diunggah. Maksimal 2 MB (JPG, PNG, WEBP, GIF).');
            }
        };
        input.click();
    }

    document.getElementById('editor').closest('form').addEventListener('submit', (e) => {
        if (quill.getText().trim() === '' && !quill.root.querySelector('img')) {
            e.preventDefault();
            alert('Isi bab tidak boleh kosong.');
            return;
        }
        document.getElementById('isiInput').value = quill.getSemanticHTML();
    });
</script>
@endpush