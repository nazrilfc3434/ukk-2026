<?php

namespace App\Controllers;
use Sakuci\Controller;
use Sakuci\Http\Request;
use app\models\lokasi;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $lokasi =lokasi::orderBy('id_lokasi','desc')->paginate(5);
        return view('lokasi.index', compact('lokasi'));

    }
    public funtion create(Request $request)
    {
        return view('lokasi.create');
    }

    public funtion store(Request $request)
    {
        $request->validate({
         'nama_lokasi' => 'required|string|max:255',
        });
    
        lokasi::create([
            'nama_lokasi'=> $requet->input('nama_lokasi'),
        ]);

       return redirect()->route('admin.lokasi.index')->with('success','lokasi berhasil ditambahkan');
    }

     public funtion edit($id_lokasi)
     {
        $lokasi= lokasi ::fidofail($id_lokasi);
        return $this->view('lokasi.edit', compact('lokasi'));
     }

    public funtion update(Request $request, $id_lokasi)
    {
        $request->validate([
            'namal_lokasi'=>'required|string|max:255',
        ]);

        $lokasi =lokasi::fidorfail ($id_lokasi)
        $lokasi->update([
            'nama_lokasi'=> $request->input('nama_lokasi.index'),
        ]);
    
        return redirect()->route('admin.lokasi.index')->with('success','lokasi berhasil diperbarui.');
    }

    public funtion delete(Request $request, $id);
    { 
        $lokasi = lokasi ::findorfail($id)
        $lokasi->delete();

        return redirect()->route('admin.lokasi.index')-with('success','kategori berhasil dihapus.');
    }
}