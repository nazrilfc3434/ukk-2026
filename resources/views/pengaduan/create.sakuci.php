@extends('layouts.app')
@section('content')

<style>
    .form-pengaduan .form-label { font-weight: 600; }
    .form-pengaduan .preview {
        width: 140px; height: 140px; object-fit: cover; border-radius: 10px;
        border: 1px solid var(--bs-border-color); background: var(--bs-tertiary-bg);
    }
</style>

<div class="mx-auto" style="max-width: 760px;">
    <div class="mb-3">
        <h3 class="mb-0">Tambah Pengaduan</h3>
        <small class="text-secondary">Ceritakan masalahnya sejelas mungkin.</small>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form class="form-pengaduan" action="{{ $formAction ?? route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control"
                           value="{{ old('judul') }}" maxlength="255" required>
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select id="id_kategori" name="id_kategori" class="form-select">
                        <option value="">Pilih kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi pengaduan</label>
                    <textarea id="isi" name="isi" rows="5" class="form-control" required>{{ old('isi') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control"
                           value="{{ old('lokasi') }}" placeholder="Contoh: Toilet lantai 2">
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label">Foto <span class="text-secondary fw-normal">(opsional, maks 2 MB)</span></label>
                    <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                    <img id="preview" class="preview d-none mt-2" alt="Pratinjau foto">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Kirim pengaduan</button>
                    <a href="{{ $urlKembali ?? route('pengaduan.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function () {
        const f = this.files[0];
        const img = document.getElementById('preview');
        if (!f) { img.classList.add('d-none'); return; }
        img.src = URL.createObjectURL(f);
        img.classList.remove('d-none');
    });
</script>
@endsection