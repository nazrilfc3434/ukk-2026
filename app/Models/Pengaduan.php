<?php

namespace App\Models;

use Sakuci\Database\Model;

class Pengaduan extends Model
{
    protected static ?string $table = 'pengaduan';
    protected string $primaryKey = 'id_pengaduan';
    protected array $fillable = [
        'id_user',
        'id_kategori',
        'judul',
        'isi',
        'lokasi',
        'foto',
        'status',
        'tanggapan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}