@extends('layouts.app')

@section('title', 'Tambah Periode')

@section('content')

<a href="{{ route('periode.index') }}" style="text-decoration:none;">
    ← Kembali
</a>

<h1 style="margin:20px 0;">Tambah Periode</h1>

@if ($errors->any())
    <div style="background:#fee2e2;padding:12px;border-radius:10px;margin-bottom:15px;">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form action="{{ route('periode.store') }}" method="POST">

    @csrf

    <label>Nama Periode</label>
    <input type="text" name="nama_periode" placeholder="Contoh: Periode I 2026"
           value="{{ old('nama_periode') }}">

    <label>Unit Kerja</label>
    <input type="text" name="unit_kerja" placeholder="Contoh: Dinas PUPR"
           value="{{ old('unit_kerja') }}">

    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai"
           value="{{ old('tanggal_mulai') }}">

    <label>Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai"
           value="{{ old('tanggal_selesai') }}">

    <label>Kuota</label>
    <input type="number" name="kuota" min="1"
           value="{{ old('kuota') }}">

    <button type="submit">
        Simpan Periode
    </button>

</form>

<style>

    label {
        display:block;
        margin-top:15px;
        margin-bottom:6px;
        font-size:13px;
        font-weight:bold;
    }

    input {
        width:100%;
        padding:13px;
        border:1px solid #ddd;
        border-radius:10px;
        font-size:14px;
    }

    button {
        width:100%;
        margin-top:25px;
        padding:14px;
        border:none;
        border-radius:10px;
        background:#2563eb;
        color:white;
        font-weight:bold;
        cursor:pointer;
    }

</style>

@endsection