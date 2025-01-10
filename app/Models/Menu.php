<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'mata_pelajaran',
        'tingkat',
        'deskripsi',
        'harga',
        'icon',
        'thumbnail',
        'kuota'
    ];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class);
    }

    public function registrasi()
    {
        return $this->hasMany(Registrasi::class);
    }

}
