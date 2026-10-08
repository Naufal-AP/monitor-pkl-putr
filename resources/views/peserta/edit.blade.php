@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Edit Peserta</h1>
        <p>Perbarui data peserta PKL</p>
    </div>
</div>

<form action="{{ route('peserta.update', $peserta) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Periode PKL</label>

        <select name="periode_id" required>
            @foreach($periodes as $periode)
                <option value="{{ $periode->id }}"
                    {{ $peserta->periode_id == $periode->id ? 'selected' : '' }}>
                    {{ $periode->nama_periode }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Nama Peserta</label>

        <input
            type="text"
            name="nama"
            value="{{ old('nama', $peserta->nama) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Institusi</label>

        <input
            type="text"
            name="institusi"
            value="{{ old('institusi', $peserta->institusi) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Jurusan</label>

        <input
            type="text"
            name="jurusan"
            value="{{ old('jurusan', $peserta->jurusan) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Pembimbing</label>

        <input
            type="text"
            name="pembimbing"
            value="{{ old('pembimbing', $peserta->pembimbing) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Tanggal Mulai</label>

        <input
            type="date"
            name="tanggal_mulai"
            value="{{ old('tanggal_mulai', $peserta->tanggal_mulai) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>

        <input
            type="date"
            name="tanggal_selesai"
            value="{{ old('tanggal_selesai', $peserta->tanggal_selesai) }}"
            required
        >
    </div>

    <button type="submit" class="btn-primary">
        Simpan Perubahan
    </button>

    <a href="{{ route('peserta.index') }}" class="btn-secondary">
        Batal
    </a>

</form>

@endsection