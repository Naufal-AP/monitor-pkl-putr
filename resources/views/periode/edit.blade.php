@extends('layouts.app')

@section('title', 'Edit Periode')

@section('content')

<a href="{{ route('periode.index') }}" class="back">
    ← Kembali
</a>

<div class="page-title">
    <p>Pengelolaan</p>
    <h1>Edit Periode</h1>
</div>

@if ($errors->any())
    <div class="error-box">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('periode.update', $periode) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Periode</label>

        <input
            type="text"
            name="nama_periode"
            value="{{ old('nama_periode', $periode->nama_periode) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Unit Kerja</label>

        <input
            type="text"
            name="unit_kerja"
            value="{{ old('unit_kerja', $periode->unit_kerja) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Tanggal Mulai</label>

        <input
            type="date"
            name="tanggal_mulai"
            value="{{ old('tanggal_mulai', $periode->tanggal_mulai) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Tanggal Selesai</label>

        <input
            type="date"
            name="tanggal_selesai"
            value="{{ old('tanggal_selesai', $periode->tanggal_selesai) }}"
            required
        >
    </div>

    <div class="form-group">
        <label>Kuota</label>

        <input
            type="number"
            name="kuota"
            min="1"
            value="{{ old('kuota', $periode->kuota) }}"
            required
        >
    </div>

    <button type="submit" class="save-btn">
        Simpan Perubahan
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

.form-group input {
    width: 100%;
    padding: 13px;

    border: 1px solid #d1d5db;
    border-radius: 10px;

    font-size: 14px;
    outline: none;
}

.form-group input:focus {
    border-color: #2563eb;
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