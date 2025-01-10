<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'asal_sekolah',
        'email',
        'nomor_hp',
        'bukti_transfer',
        'menu_id',
        'ruangan_id',
        'status',
        'registration_code',
    ];
    
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }  

}
