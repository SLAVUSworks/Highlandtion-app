<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juknis extends Model
{
    protected $table = 'juknis';

    protected $fillable = [
        'nama_event',
        'keterangan',
        'file_pdf',
        'nama_file_asli',
    ];
}
