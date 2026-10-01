<?php

namespace App\Models;

use Sakuci\Database\Model;

class Pengaduan extends Model
{
    protected static ?string $table = 'pengaduan';
    protected string $primaryKey = 'id_pengaduan';
    protected array $fillable = ['id_user', 'judul', 'isi', 'foto', 'status'];
}