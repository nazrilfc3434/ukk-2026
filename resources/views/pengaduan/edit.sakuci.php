@extends('layouts.app')
@section('content')

<style>
    .form-pengaduan .form-label { font-weight: 600; }
    .form-pengaduan .preview {
        width: 140px; height: 140px; object-fit: cover; border-radius: 10px;
        border: 1px solid var(--bs-border-color); background: var(--bs-tertiary-bg);
    }
    .form-pengaduan .preview-kosong {
        display: grid; place-items: center; color: var(--bs-secondary-color); font-size: .85rem;
    }
</style>

<div class="mx-auto" style="max-width: 760px;">
    <div class="mb-3">
        <h3 class="mb-0">Edit Pengaduan</h3>
        <small class="text-secondary">Perbarui detail laporan, lalu simpan.</small>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <form class="form-pengaduan"
                  action="{{ route('pengaduan.update', ['id' => $data->id_pengaduan]) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" id="judul" name="judul" class="form-control"
                           value="{{ old('judul', $data->judul) }}" maxlength="255" required>
                </div>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select id="id_kategori" name="id_kategori" class="form-select">
                        <option value="">Pilih kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id_kategori }}"
                                {{ old('id_kategori', $data->id_kategori ?? '') == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi pengaduan</label>
                    <textarea id="isi" name="isi" rows="5" class="form-control" required>{{ old('isi', $data->isi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control"
                           value="{{ old('lokasi', $data->lokasi) }}" placeholder="Contoh: Toilet lantai 2">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Foto saat ini</label>
                    @if ($data->foto)
                        <img id="preview" src="/uploads/pengaduan/{{ $data->foto }}" class="preview" alt="Foto pengaduan">
                    @else
                        <div id="kosong" class="preview preview-kosong">Belum ada foto</div>
                        <img id="preview" class="preview d-none" alt="Pratinjau foto baru">
                    @endif
                </div>

                <div class="mb-4">
                    <label for="foto" class="form-label">Ganti foto <span class="text-secondary fw-normal">(opsional, maks 2 MB)</span></label>
                    <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('foto').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const img = document.getElementById('preview');
        const kosong = document.getElementById('kosong');
        img.src = URL.createObjectURL(file);
        img.classList.remove('d-none');
        if (kosong) kosong.classList.add('d-none');
    });
</script>
@endsection