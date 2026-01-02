<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registrasi extends Model
{
    public $incrementing = true;
    protected $primaryKey = 'nomor_urut';
    protected $keyType = 'int';

    public function getNomorUrutFormattedAttribute()
    {
        return str_pad($this->nomor_urut, 5, '0', STR_PAD_LEFT);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'id';
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
        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });

        static::saved(function ($registrasi) {
            if ($registrasi->menu) {
                $registrasi->menu->updateKuotaNow();
            }

            if ($registrasi->ruangan) {
                $registrasi->ruangan->updateKuotaNow();
            }
        });

        static::deleted(function ($registrasi) {
            if ($registrasi->menu) {
                $registrasi->menu->updateKuotaNow();
            }

            if ($registrasi->ruangan) {
                $registrasi->ruangan->updateKuotaNow();
            }
        });
    }
}
