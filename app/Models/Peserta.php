<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Periode;

class Peserta extends Model
{
    protected $fillable = [
        'periode_id',
        'nama',
        'institusi',
        'jurusan',
        'pembimbing',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }
}