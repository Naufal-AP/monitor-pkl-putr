@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')

<a href="{{ route('peserta.index') }}" class="back">
    ← Kembali
</a>

<div class="page-title">
    <p>Data PKL</p>
    <h1>Tambah Peserta</h1>
</div>

@if ($errors->any())
    <div class="error-box">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if(session('error'))
    <div class="error-box">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('peserta.store') }}" method="POST">

    @csrf

    <div class="form-group">
        <label>Periode PKL</label>

        <select name="periode_id" required>
            <option value="">Pilih periode</option>

            @foreach($periodes as $periode)
                @php
                    $terisi = $periode->peserta()->count();
                    $penuh = $terisi >= $periode->kuota;
                @endphp

                <option
                    value="{{ $periode->id }}"
                    {{ old('periode_id') == $periode->id ? 'selected' : '' }}
                    {{ $penuh ? 'disabled' : '' }}
                >
                    {{ $periode->nama_periode }}
                    — {{ $terisi }}/{{ $periode->kuota }}
                    {{ $penuh ? '(PENUH)' : '' }}
                </option>
            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label>Nama Peserta</label>

        <input
            type="text"
            name="nama"
            value="{{ old('nama') }}"
            placeholder="Masukkan nama peserta"
            required
        >
    </div>

    <div class="form-group">
        <label>Institusi</label>

        <input
            type="text"
            name="institusi"
            value="{{ old('institusi') }}"
            placeholder="Contoh: Universitas Kuningan"
            required
        >
    </div>

    <div class="form-group">
        <label>Jurusan</label>

        <input
            type="text"
            name="jurusan"
            value="{{ old('jurusan') }}"
            placeholder="Contoh: Sistem Informasi"
            required
        >
    </div>

    <div class="form-group">
        <label>Pembimbing</label>

        <input
            type="text"
            name="pembimbing"
            value="{{ old('pembimbing') }}"
            placeholder="Nama pembimbing"
            required
        >
    </div>

    <div class="form-group">
        <label>Tanggal Mulai</label>

        <input
            type="date"
            name="tanggal_mulai"
            value="{{ old('tanggal_mulai') }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>

        <input
            type="date"
            name="tanggal_selesai"
            value="{{ old('tanggal_selesai') }}"
            required
        >
    </div>

    <button type="submit" class="save-btn">
        Simpan Peserta
    </button>

</form>

<style>

.back {
    text-decoration: none;
    color: #2563eb;
    font-size: 13px;
}

.page-title {
    margin: 22px 0;
}

.page-title p {
    color: #6b7280;
    font-size: 12px;
    margin-bottom: 5px;
}

.page-title h1 {
    font-size: 24px;
}

.error-box {
    background: #fee2e2;
    color: #991b1b;
    padding: 12px;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 17px;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 7px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 13px;

    border: 1px solid #d1d5db;
    border-radius: 10px;

    font-size: 14px;
    background: white;
}

.save-btn {
    width: 100%;
    border: none;

    padding: 14px;

    background: #2563eb;
    color: white;

    border-radius: 10px;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;
}

</style>

@endsection