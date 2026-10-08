@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="header">
    <div>
        <p class="welcome">Selamat datang 👋</p>
        <h1>Monitor PKL PUPR</h1>
    </div>

    <div class="profile">
        A
    </div>
</div>

<div class="stats">

    <div class="stat-card">
        <span class="icon blue">👥</span>
        <p>PKL Aktif</p>
        <h2>{{ $pesertaAktif }}</h2>
    </div>

    <div class="stat-card">
        <span class="icon green">✓</span>
        <p>PKL Selesai</p>
        <h2>{{ $pesertaSelesai }}</h2>
    </div>

</div>

<div class="section-header">
    <h2>Aksi Cepat</h2>
</div>

<div class="quick-actions">

    <a href="#" class="action-card">
        <span>＋</span>
        <div>
            <strong>Tambah Peserta</strong>
            <small>Daftarkan peserta PKL baru</small>
        </div>
    </a>

    <a href="#" class="action-card">
        <span>＋</span>
        <div>
            <strong>Tambah Periode</strong>
            <small>Buat periode PKL baru</small>
        </div>
    </a>

</div>

<div class="section-header">
    <h2>Periode PKL</h2>
    <a href="#">Lihat semua</a>
</div>

@foreach($periodes as $periode)

    @php
        $terisi = $periode->peserta_aktif_count;

        $persentase = $periode->kuota > 0
            ? min(($terisi / $periode->kuota) * 100, 100)
            : 0;

        $penuh = $terisi >= $periode->kuota;
    @endphp

    <div class="period-card">

        <div class="period-top">

            <div>
                <strong>{{ $periode->nama_periode }}</strong>

                <small>{{ $periode->unit_kerja }}</small>
            </div>

            @if($penuh)
                <span class="badge full">
                    PENUH
                </span>
            @else
                <span class="badge">
                    TERSEDIA
                </span>
            @endif

        </div>

        <div class="quota">

            <div class="quota-text">

                <span>Kuota terisi</span>

                <strong>
                    {{ $terisi }} / {{ $periode->kuota }}
                </strong>

            </div>

            <div class="progress">

                <div
                    class="progress-bar"
                    style="width: {{ $persentase }}%">
                </div>

            </div>

        </div>

    </div>

@endforeach

@endsection

@push('styles')
<style>

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .welcome {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 5px;
    }

    .header h1 {
        font-size: 22px;
    }

    .profile {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #2563eb;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    .stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 28px;
    }

    .stat-card {
        padding: 18px;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
    }

    .stat-card p {
        font-size: 13px;
        color: #6b7280;
        margin: 12px 0 5px;
    }

    .stat-card h2 {
        font-size: 28px;
    }

    .icon {
        display: inline-flex;
        width: 36px;
        height: 36px;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .blue {
        background: #eff6ff;
    }

    .green {
        background: #ecfdf5;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 24px 0 12px;
    }

    .section-header h2 {
        font-size: 17px;
    }

    .section-header a {
        color: #2563eb;
        font-size: 13px;
        text-decoration: none;
    }

    .quick-actions {
        display: grid;
        gap: 10px;
    }

    .action-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        text-decoration: none;
        color: #111827;
    }

    .action-card > span {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 10px;
        font-size: 22px;
    }

    .action-card strong {
        display: block;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .action-card small {
        color: #6b7280;
        font-size: 11px;
    }

    .period-card {
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 16px;
    }

    .period-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .period-top strong {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .period-top small {
        color: #6b7280;
        font-size: 11px;
    }

    .badge {
        background: #dcfce7;
        color: #15803d;
        padding: 5px 8px;
        border-radius: 6px;
        font-size: 9px;
        font-weight: bold;
        height: fit-content;
    }

    .quota {
        margin-top: 18px;
    }

    .quota-text {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
        margin-bottom: 7px;
    }

    .quota-text span {
        color: #6b7280;
    }

    .progress {
        height: 7px;
        background: #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar {
        width: 0%;
        height: 100%;
        background: #2563eb;
    }

    .badge.full {
    background: #fee2e2;
    color: #dc2626;

    .search-form {
    display: flex;
    gap: 8px;
    margin-bottom: 18px;
}

.search-form input {
    flex: 1;
    padding: 12px 14px;

    border: 1px solid #e5e7eb;
    border-radius: 10px;

    font-size: 13px;
    outline: none;
}

.search-form input:focus {
    border-color: #2563eb;
}

.search-form button {
    width: 44px;

    border: none;
    border-radius: 10px;

    background: #2563eb;
    color: white;

    cursor: pointer;
}
}

</style>
@endpush