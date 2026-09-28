<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Siswa;
use App\Models\User;

class PenggunaController extends Controller
{
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

        $user = User::create([
            'username' => $request->nama,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'role'     => 'siswa',
        ]);

        Siswa::create([
            'nama'    => $request->nama,
            'nis'     => $request->nis,
            'kelas'   => $request->kelas,
            'id_user' => $user->id,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($pengguna)
    {
        $siswa = Siswa::where('id_siswa', $pengguna)->first();
        return view('pengguna.edit', compact('siswa'));
    }

    public function update(Request $request, $pengguna)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'required|string|unique:siswa,nis,' . $pengguna . ',id_siswa',
            'kelas' => 'required|string|max:10',
        ]);

        $user = Siswa::where('id_siswa', $pengguna)->first();
        $user->update([
            'nama'  => $request->nama,
            'nis'   => $request->nis,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('pengguna.index');
    }

   public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'pengguna berhasil dihapus.');
    }
}