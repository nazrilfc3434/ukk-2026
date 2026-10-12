<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Alat;
use App\Models\Kategori;

class PenggunaController extends Controller
{
    private const PASSWORD_AWAL = '123456';

    // PERIKSA: sesuaikan dengan primary key tabel kamu
    private const PK_PENGADUAN = 'id_pengaduan'; // sudah dipastikan dari PengaduanController
    private const PK_ALAT      = 'id_alat';      // sudah dipastikan dari AlatController

    /* ------------------------------------------------------------------
     | Bagian admin: kelola data siswa
     ------------------------------------------------------------------ */

    public function index(Request $request)
    {
        $data = Siswa::leftJoin('users', 'siswa.id_user', '=', 'users.id')
            ->orderBy('siswa.id_siswa', 'desc')
            ->paginate(5);

        return view('pengguna.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis',
            'kelas' => 'required|string|max:10',
        ]);

        $nama = trim($request->nama);

        // Username diambil dari nama, jadi pastikan belum dipakai akun lain
        if (User::where('username', $nama)->first()) {
            return redirect()->route('pengguna.create')
                ->with('error', 'Username "' . $nama . '" sudah dipakai akun lain. Tambahkan pembeda pada nama, misalnya inisial.');
        }

        $user = User::create([
            'username' => $nama,
            'password' => password_hash(self::PASSWORD_AWAL, PASSWORD_DEFAULT),
            'role'     => 'siswa',
        ]);

        try {
            Siswa::create([
                'nama'    => $nama,
                'nis'     => $request->nis,
                'kelas'   => $request->kelas,
                'id_user' => $user->id,
            ]);
        } catch (\Throwable $e) {
            // Batalkan akun yang sudah terlanjur dibuat
            $user->delete();

            return redirect()->route('pengguna.create')
                ->with('error', 'Data siswa gagal disimpan. Coba lagi.');
        }

        return redirect()->route('pengguna.index')
            ->with('success', 'Siswa ditambahkan. Login dengan username "' . $nama . '" dan password awal ' . self::PASSWORD_AWAL . '.');
    }

    public function edit($pengguna)
    {
        $siswa = Siswa::where('id_siswa', $pengguna)->first();

        if (!$siswa) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('pengguna.edit', compact('siswa'));
    }

    public function update(Request $request, $pengguna)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis,' . $pengguna . ',id_siswa',
            'kelas' => 'required|string|max:10',
        ]);

        $siswa = Siswa::where('id_siswa', $pengguna)->first();

        if (!$siswa) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->update([
            'nama'  => trim($request->nama),
            'nis'   => $request->nis,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('pengguna.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Request $request, $pengguna)
    {
        // $pengguna adalah id_siswa, bukan id user
        $siswa = Siswa::where('id_siswa', $pengguna)->first();

        if (!$siswa) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Data siswa tidak ditemukan.');
        }

        $user = User::where('id', $siswa->id_user)->first();

        // Akun admin tidak boleh terhapus lewat halaman ini
        if ($user && $user->role === 'admin') {
            return redirect()->route('pengguna.index')
                ->with('error', 'Akun admin tidak bisa dihapus dari sini.');
        }

        // Siswa yang sudah pernah melapor tidak dihapus, supaya riwayat laporan aman
        if ($user && Pengaduan::where('id_user', $user->id)->first()) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Siswa ini sudah punya pengaduan, jadi tidak bisa dihapus.');
        }

        try {
            $siswa->delete();
            if ($user) {
                $user->delete();
            }
        } catch (\Throwable $e) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Siswa gagal dihapus. Coba lagi.');
        }

        return redirect()->route('pengguna.index')
            ->with('success', 'Siswa dan akunnya berhasil dihapus.');
    }

    /* ------------------------------------------------------------------
     | Bagian siswa: pengaduan milik sendiri dan daftar alat
     ------------------------------------------------------------------ */

    // Sama seperti middleware EnsureRole: user login diambil lewat User::current()
    private function idUserLogin()
    {
        $user = User::current();

        return $user ? $user->id : null;
    }

    // Daftar pengaduan milik siswa yang sedang login
    public function pengaduan(Request $request)
    {
        $data = Pengaduan::where('id_user', $this->idUserLogin())
            ->orderBy(self::PK_PENGADUAN, 'desc')
            ->paginate(5);

        // Peta id => nama, sama seperti di PengaduanController::index
        $kategori = [];
        foreach (Kategori::orderBy('nama_kategori')->get() as $k) {
            $kategori[$k->id_kategori] = $k->nama_kategori;
        }

        return view('siswa.pengaduan.index', compact('data', 'kategori'));
    }

    // Detail satu pengaduan (hanya boleh milik sendiri)
    public function pengaduanShow($id)
    {
        $pengaduan = Pengaduan::where(self::PK_PENGADUAN, $id)
            ->where('id_user', $this->idUserLogin())
            ->first();

        if (!$pengaduan) {
            return redirect()->route('siswa.pengaduan.index')
                ->with('error', 'Pengaduan tidak ditemukan.');
        }

        return view('siswa.pengaduan.show', compact('pengaduan'));
    }

    // Daftar alat & fasilitas (read-only)
    public function alat(Request $request)
    {
        $data = Alat::orderBy(self::PK_ALAT, 'desc')->paginate(10);

        return view('siswa.alat', compact('data'));
    }
}