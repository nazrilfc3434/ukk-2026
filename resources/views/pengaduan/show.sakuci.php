@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Detail Pengaduan -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Detail Pengaduan</h5>
                </div>
                <div class="card-body">
                    <h4>{{ $pengaduan->judul }}</h4>
                    <p class="text-muted">Status: <strong>{{ ucfirst($pengaduan->status) }}</strong></p>
                    <hr>
                    <p>{{ $pengaduan->isi }}</p>

                    @if ($pengaduan->foto)
                        <div class="mt-3">
                            <label class="fw-bold d-block mb-2">Lampiran Foto:</label>
                            <img src="/uploads/pengaduan/{{ $pengaduan->foto }}" class="img-fluid rounded" alt="Foto Pengaduan">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Tanggapan Admin -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Tanggapan Admin</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengaduan.tanggapan', ['id' => $pengaduan->id_pengaduan]) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="status" class="form-label">Ubah Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggapan" class="form-label">Isi Tanggapan</label>
                            <textarea name="tanggapan" id="tanggapan" rows="5" class="form-control" placeholder="Tulis tanggapan di sini..." required>{{ $pengaduan->tanggapan ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Simpan Tanggapan</button>
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary w-100 mt-2">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection