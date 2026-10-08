<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Periode;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
public function index(Request $request)
{
    $query = Peserta::with('periode')
        ->where('status', 'aktif');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('institusi', 'like', "%{$search}%")
              ->orWhere('jurusan', 'like', "%{$search}%");
        });
    }

    $pesertas = $query
        ->latest()
        ->get();

    return view('peserta.index', compact('pesertas'));
}

public function selesaiList(Request $request)
{
    $query = Peserta::with('periode')
        ->where('status', 'selesai');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('institusi', 'like', "%{$search}%")
              ->orWhere('jurusan', 'like', "%{$search}%");
        });
    }

    $pesertas = $query
        ->latest()
        ->get();

    return view('peserta.selesai', compact('pesertas'));
}

    public function create()
    {
        $periodes = Periode::orderBy('tanggal_mulai')->get();

        return view('peserta.create', compact('periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periodes,id',
            'nama' => 'required|string|max:255',
            'institusi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

$periode = Periode::findOrFail($request->periode_id);

$terisi = $periode->peserta()
    ->where('status', 'aktif')
    ->count();

if ($terisi >= $periode->kuota) {
    return back()
        ->withInput()
        ->with('error', 'Kuota periode tersebut sudah penuh.');
}
        Peserta::create([
            'periode_id' => $request->periode_id,
            'nama' => $request->nama,
            'institusi' => $request->institusi,
            'jurusan' => $request->jurusan,
            'pembimbing' => $request->pembimbing,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif',
        ]);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    public function edit(Peserta $peserta)
{
    $periodes = Periode::orderBy('tanggal_mulai')->get();

    return view('peserta.edit', compact('peserta', 'periodes'));
}

public function update(Request $request, Peserta $peserta)
{
    $request->validate([
        'periode_id' => 'required|exists:periodes,id',
        'nama' => 'required|string|max:255',
        'institusi' => 'required|string|max:255',
        'jurusan' => 'required|string|max:255',
        'pembimbing' => 'required|string|max:255',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $peserta->update([
        'periode_id' => $request->periode_id,
        'nama' => $request->nama,
        'institusi' => $request->institusi,
        'jurusan' => $request->jurusan,
        'pembimbing' => $request->pembimbing,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
    ]);

    return redirect()
        ->route('peserta.index')
        ->with('success', 'Data peserta berhasil diperbarui.');
}

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil dihapus.');
    }

    public function selesai(Peserta $peserta)
    {
        $peserta->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil ditandai selesai.');
    }

    public function show(Peserta $peserta)
{
    $peserta->load('periode');

    return view('peserta.show', compact('peserta'));
}
}