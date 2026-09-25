<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Siswa;
use App\Models\User;
class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $data = siswa::leftjoin('Users','siswa.id_user','=','users.id')
           ->orderBy('siswa.id_siswa','desc')
           ->paginate(5);
        return view('siswa.index', compact('data'));
    }
 public function create(Request $request)
 {
     return view('pengguna.create');
 }
 public function store(Request $request)
{
    $requst->validate([
        'nama'=>'required|string|max:255',
        'nis'=>'required|string|unique:siswa',
        'kelas'=>'required|string|max:10'
    ]);

    $user =User::create([
       'nama'=> $request->nis, 
       'password'=> password_hash('1234556',PASSWORD_DEFAULT),
       'role'=> 'siswa'
    ]);
     
     Siswa::create([
        'nama'=> $requst->nama,
        'nis'=> $requst-nis,
        'kelas'=>$requst->kelas,
        'id_user'=> $user->id
     ]);
      return redirect()->route('pengguna.index')->with('success','pengguna berhasil ditambahkan');
}
}
