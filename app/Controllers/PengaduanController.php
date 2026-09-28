<?php

namespace App\Controllers;

use SakuCI\Controller;
use SakuCI\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $data = Pengaduan::orderBy('id_pengaduan', 'desc')
            ->paginate(5);

        return view('pengaduan.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable'
        ]);

        $namaFoto = null;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

            $folder = 'public/uploads/pengaduan/';

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $namaFoto = time() . '_' . $_FILES['foto']['name'];

            move_uploaded_file(
                $_FILES['foto']['tmp_name'],
                $folder . $namaFoto
            );
        }

        Pengaduan::create([
            'id_user' => 1,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $namaFoto,
            'status' => 'menunggu'
        ]);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditambahkan.');
    }

    public function edit($pengaduan)
    {
        $data = Pengaduan::where(
            'id_pengaduan',
            $pengaduan
        )->first();

        return view('pengaduan.edit', compact('data'));
    }

    public function update(Request $request, $pengaduan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $data = Pengaduan::where(
            'id_pengaduan',
            $pengaduan
        )->first();

        $namaFoto = $data->foto;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {

            $folder = 'public/uploads/pengaduan/';

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $namaFoto = time() . '_' . $_FILES['foto']['name'];

            move_uploaded_file(
                $_FILES['foto']['tmp_name'],
                $folder . $namaFoto
            );
        }

        $data->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $namaFoto
        ]);

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $data = Pengaduan::where(
            'id_pengaduan',
            $id
        )->first();

        if ($data) {
            $data->delete();
        }

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus.');
    }
}