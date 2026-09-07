<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $data = kategori::paginate(5);
        return $this->view('kategori.index', compact('data') );
    }
    public function create( request $request)
    {
        return $this->view('kategori.create');
}
}