<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    protected $table = 'lokasi';

        protected $primaryKey = 'id_lokasi';

            public $timestamps = false;

                protected $fillable = [
                        'nama_lokasi',
                            ];
                            }