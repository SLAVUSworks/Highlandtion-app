<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ruangan',
        'kuota',
        'kuota_now',
        'menu_id'
    ];

    public function updateKuotaNow()
    {
        $this->kuota_now = $this->registrasi()->where('status', 'approved')->count();
        $this->save();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function registrasi()
    {
        return $this->hasMany(Registrasi::class);
    }

}
