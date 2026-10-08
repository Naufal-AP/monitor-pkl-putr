<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Peserta;

class Periode extends Model
{
    protected $fillable = [
        'nama_periode',
        'unit_kerja',
        'tanggal_mulai',
        'tanggal_selesai',
        'kuota',
    ];

    public function peserta(): HasMany
    {
        return $this->hasMany(Peserta::class);
    }
}