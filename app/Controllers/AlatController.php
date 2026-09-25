<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $data = Alat::OrderBy('id_alat', 'desc')->paginate(5);
        return view('alat.index', compact('data'));
    }

    public function create(Request $request)
    {
        $kategori = Kategori::all();
        return view('alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_alat' => 'required|string|max:255|unique:alat,kode_alat',
            'nama_alat' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
            'id_kategori' => 'nullable|exists:kategori,id_kategori'
        ]);

        Alat::create($data);
        return redirect(route('alat.index'))->with('success', 'Data berhasil disimpan');
    }

    public function edit(Request $request, $id)
    {
        $data = Alat::FindOrFail($id);
        $kategori = Kategori::all();
        return view('alat.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $id)
{
    $data = Alat::FindOrFail($id);
    $validatedData = $request->validate([
        'kode_alat'   => 'required|string|max:255|unique:alat,kode_alat,' . $data->id_alat . ',id_alat',
        'nama_alat'   => 'required|string|max:255',
        'stok'        => 'required|numeric|min:0',
        'id_kategori' => 'nullable|exists:kategori,id_kategori',
    ]);

    $data->update($validatedData);

    return redirect(route('alat.index'))->with('success', 'Data berhasil diperbarui');
 }
    public function destroy(Request $request, $id)
    {
        $data = Alat::FindOrFail($id);
        $data->delete();
        return redirect(route('alat.index'))->with('success', 'Data berhasil dihapus');
    }
}