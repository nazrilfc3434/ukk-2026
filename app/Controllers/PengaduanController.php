<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengaduan;
use App\Models\Kategori;
use App\Models\User;

class PengaduanController extends Controller
{
    private string $folderFoto = 'public/uploads/pengaduan/';

    /* ------------------------------------------------------------------
     | Helper user login
     | Memakai User::current(), sama seperti middleware EnsureRole.
     ------------------------------------------------------------------ */

    private function idUserLogin()
    {
        $user = User::current();

        return $user ? $user->id : null;
    }

    // Penentuan siswa/admin memakai alamat URL, bukan data login, karena route
    // siswa sudah dijaga middleware 'siswa'. Jadi tidak perlu menebak struktur auth.
    private function loginSebagaiSiswa(): bool
    {
        $path = trim((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');

        return $path === 'siswa' || strpos($path, 'siswa/') === 0;
    }

    // Nama route tujuan: siswa memakai route siswa.*, admin memakai route biasa
    private function namaRoute(string $nama): string
    {
        return $this->loginSebagaiSiswa() ? 'siswa.' . $nama : $nama;
    }

    /* ------------------------------------------------------------------
     | CRUD pengaduan
     ------------------------------------------------------------------ */

    public function index(Request $request)
    {
        $data = Pengaduan::orderBy('id_pengaduan', 'desc')->paginate(5);

        // Peta id => nama, dipakai kolom Kategori di tabel
        $kategori = [];
        foreach (Kategori::orderBy('nama_kategori')->get() as $k) {
            $kategori[$k->id_kategori] = $k->nama_kategori;
        }

        return view('pengaduan.index', compact('data', 'kategori'));
    }

    public function create(Request $request)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        // $formAction dan $urlKembali dipakai di view pengaduan/create,
        // supaya siswa memakai route siswa dan admin memakai route admin.
        $formAction = route($this->namaRoute('pengaduan.store'));
        $urlKembali = route($this->namaRoute('pengaduan.index'));

        return view('pengaduan.create', compact('kategori', 'formAction', 'urlKembali'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'isi'         => 'required|string',
            'lokasi'      => 'nullable|string|max:255',
            'id_kategori' => 'nullable|integer',
        ]);

        $idUser = $this->idUserLogin();

        if (!$idUser) {
            return redirect()->route('login')
                ->with('error', 'Sesi login tidak ditemukan. Silakan login ulang.');
        }

        $namaFoto = $this->simpanFoto();

        if ($namaFoto === false) {
            return redirect()->route($this->namaRoute('pengaduan.create'))
                ->with('error', 'Foto harus berupa gambar (jpg, png, gif, webp) maksimal 2 MB.');
        }

        Pengaduan::create([
            'id_user'     => $idUser,
            'id_kategori' => $request->id_kategori ?: null,
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'lokasi'      => $request->lokasi,
            'foto'        => $namaFoto,
            'status'      => 'menunggu',
        ]);

        return redirect()->route($this->namaRoute('pengaduan.index'))
            ->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit($pengaduan)
    {
        $data = Pengaduan::where('id_pengaduan', $pengaduan)->first();

        if (!$data) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Data pengaduan tidak ditemukan.');
        }

        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('pengaduan.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $pengaduan)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'isi'         => 'required|string',
            'lokasi'      => 'nullable|string|max:255',
            'id_kategori' => 'nullable|integer',
        ]);

        $data = Pengaduan::where('id_pengaduan', $pengaduan)->first();

        if (!$data) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Data pengaduan tidak ditemukan.');
        }

        $namaFoto = $data->foto;
        $fotoBaru = $this->simpanFoto();

        if ($fotoBaru === false) {
            return redirect()->route('pengaduan.edit', ['id' => $pengaduan])
                ->with('error', 'Foto harus berupa gambar (jpg, png, gif, webp) maksimal 2 MB.');
        }

        if ($fotoBaru !== null) {
            $this->hapusFoto($data->foto);
            $namaFoto = $fotoBaru;
        }

        $data->update([
            'id_kategori' => $request->id_kategori ?: null,
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'lokasi'      => $request->lokasi,
            'foto'        => $namaFoto,
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $data = Pengaduan::where('id_pengaduan', $id)->first();

        if ($data) {
            $this->hapusFoto($data->foto);
            $data->delete();
        }

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }

    // Menampilkan detail & form tanggapan
    public function show($id)
    {
        $pengaduan = Pengaduan::where('id_pengaduan', $id)->first();

        if (!$pengaduan) {
            abort(404, 'Pengaduan tidak ditemukan.');
        }

        return view('pengaduan.show', compact('pengaduan'));
    }

    // Menyimpan tanggapan & memperbarui status
    public function tanggapan(Request $request, $id)
    {
        $request->validate([
            'status'    => 'required',
            'tanggapan' => 'required',
        ]);

        $pengaduan = Pengaduan::where('id_pengaduan', $id)->first();

        if (!$pengaduan) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Data pengaduan tidak ditemukan.');
        }

        $pengaduan->update([
            'status'    => $request->status,
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Tanggapan berhasil disimpan.');
    }

    /**
     * Simpan foto upload dengan aman.
     * Return: nama file baru | null (tidak ada upload) | false (file tidak valid)
     */
    private function simpanFoto()
    {
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $file = $_FILES['foto'];

        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2 * 1024 * 1024) {
            return false;
        }

        // Cek isi file yang sebenarnya, bukan ekstensi dari nama aslinya
        $mime = (new \finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $ekstensi = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
        ];

        if (!isset($ekstensi[$mime])) {
            return false;
        }

        if (!is_dir($this->folderFoto)) {
            mkdir($this->folderFoto, 0755, true);
        }

        // Nama acak, ekstensi ditentukan server
        $nama = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ekstensi[$mime];

        if (!move_uploaded_file($file['tmp_name'], $this->folderFoto . $nama)) {
            return false;
        }

        return $nama;
    }

    private function hapusFoto($nama): void
    {
        if (!$nama) {
            return;
        }

        $path = $this->folderFoto . basename($nama);

        if (is_file($path)) {
            unlink($path);
        }
    }
}