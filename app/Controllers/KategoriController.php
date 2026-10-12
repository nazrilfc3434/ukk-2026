<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $data = Kategori::orderBy('nama_kategori')->paginate(10);

        return view('kategori.index', compact('data'));
    }

    public function create(Request $request)
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $nama = trim($request->nama_kategori);

        if (Kategori::where('nama_kategori', $nama)->first()) {
            return redirect()->route('kategori.create')
                ->with('error', 'Kategori "' . $nama . '" sudah ada.');
        }

        Kategori::create(['nama_kategori' => $nama]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Kategori::where('id_kategori', $id)->first();

        if (!$data) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        return view('kategori.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $data = Kategori::where('id_kategori', $id)->first();

        if (!$data) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        $nama = trim($request->nama_kategori);
        $kembar = Kategori::where('nama_kategori', $nama)->first();

        if ($kembar && $kembar->id_kategori != $id) {
            return redirect()->route('kategori.edit', ['id' => $id])
                ->with('error', 'Kategori "' . $nama . '" sudah ada.');
        }

        $data->update(['nama_kategori' => $nama]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $data = Kategori::where('id_kategori', $id)->first();

        if ($data) {
            $data->delete();
        }

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}