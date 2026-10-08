@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h1>Detail Peserta</h1>
        <p>Informasi lengkap peserta PKL</p>
    </div>
</div>

<div class="detail-card">

    <div class="detail-avatar">
        {{ strtoupper(substr($peserta->nama, 0, 1)) }}
    </div>

    <h2>{{ $peserta->nama }}</h2>

    <span class="status-badge">
        {{ strtoupper($peserta->status) }}
    </span>

    <div class="detail-list">

        <div class="detail-item">
            <span>Institusi</span>
            <strong>{{ $peserta->institusi }}</strong>
        </div>

        <div class="detail-item">
            <span>Jurusan</span>
            <strong>{{ $peserta->jurusan }}</strong>
        </div>

        <div class="detail-item">
            <span>Pembimbing</span>
            <strong>{{ $peserta->pembimbing }}</strong>
        </div>

        <div class="detail-item">
            <span>Periode</span>
            <strong>{{ $peserta->periode->nama_periode }}</strong>
        </div>

        <div class="detail-item">
            <span>Unit Kerja</span>
            <strong>{{ $peserta->periode->unit_kerja }}</strong>
        </div>

        <div class="detail-item">
            <span>Tanggal Mulai</span>
            <strong>
                {{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->format('d/m/Y') }}
            </strong>
        </div>

        <div class="detail-item">
            <span>Tanggal Selesai</span>
            <strong>
                {{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('d/m/Y') }}
            </strong>
        </div>

    </div>

    <div class="detail-actions">

        <a href="{{ route('peserta.edit', $peserta) }}" class="btn-primary">
            Edit Peserta
        </a>

        <a href="{{ route('peserta.index') }}" class="btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection