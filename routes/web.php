<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PesertaController;
use App\Models\Peserta;
use App\Models\Periode;

Route::get('/', function () {
    $pesertaAktif = Peserta::where('status', 'aktif')->count();
    $pesertaSelesai = Peserta::where('status', 'selesai')->count();

    $periodes = Periode::withCount([
        'peserta as peserta_aktif_count' => function ($query) {
            $query->where('status', 'aktif');
        }
    ])->latest()->get();

    return view('dashboard', compact(
        'pesertaAktif',
        'pesertaSelesai',
        'periodes'
    ));
});

Route::resource('periode', PeriodeController::class);

Route::get('/peserta', [PesertaController::class, 'index'])
    ->name('peserta.index');

Route::get('/peserta/create', [PesertaController::class, 'create'])
    ->name('peserta.create');

Route::post('/peserta', [PesertaController::class, 'store'])
    ->name('peserta.store');

Route::get('/peserta/selesai', [PesertaController::class, 'selesaiList'])
    ->name('peserta.selesai.list');

Route::get('/peserta/{peserta}', [PesertaController::class, 'show'])
    ->name('peserta.show');

Route::get('/peserta/{peserta}/edit', [PesertaController::class, 'edit'])
    ->name('peserta.edit');

Route::put('/peserta/{peserta}', [PesertaController::class, 'update'])
    ->name('peserta.update');

Route::patch('/peserta/{peserta}/selesai', [PesertaController::class, 'selesai'])
    ->name('peserta.selesai');

Route::delete('/peserta/{peserta}', [PesertaController::class, 'destroy'])
    ->name('peserta.destroy');