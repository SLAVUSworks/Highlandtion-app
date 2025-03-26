<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registrasi extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

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
        'is_notified',
        'note'
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    protected static function booted()
    {
        static::saved(function ($registrasi) {
            // Update kuota menu
            if ($registrasi->menu) {
                $registrasi->menu->updateKuotaNow();
            }

            // Update kuota ruangan (jika ada)
            if ($registrasi->ruangan) {
                $registrasi->ruangan->updateKuotaNow();
            }
        });

        static::deleted(function ($registrasi) {
            // Update kuota menu
            if ($registrasi->menu) {
                $registrasi->menu->updateKuotaNow();
            }

            // Update kuota ruangan (jika ada)
            if ($registrasi->ruangan) {
                $registrasi->ruangan->updateKuotaNow();
            }
        });
    }
}
