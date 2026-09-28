<?php

namespace App\Models;

use SakuCI\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'id_user',
        'judul',
        'isi',
        'foto',
        'status'
    ];
}