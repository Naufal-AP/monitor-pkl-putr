@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="dashboard">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <header class="dashboard-header">

        <div class="brand-section">

            <div class="institution-mark">
                <span>PU</span>
            </div>

            <div class="institution-info">
                <span class="institution-name">
                    DINAS PEKERJAAN UMUM
                </span>

                <span class="institution-subtitle">
                    DAN TATA RUANG
                </span>
            </div>

        </div>


        <div class="system-status">

            <span class="status-indicator"></span>

            <span>Sistem Aktif</span>

        </div>

    </header>


    {{-- =====================================================
        PAGE INTRO
    ====================================================== --}}

    <section class="page-intro">

        <div>

            <span class="eyebrow">
                SISTEM MONITORING
            </span>

            <h1>
                Monitor PKL
            </h1>

            <p>
                Pengelolaan dan monitoring peserta praktik kerja lapangan.
            </p>

        </div>

    </section>


    {{-- =====================================================
        SUMMARY
    ====================================================== --}}

    <section class="summary-section">

        <div class="section-heading">

            <div>

                <span class="section-kicker">
                    RINGKASAN
                </span>

                <h2>
                    Kondisi Peserta
                </h2>

            </div>

            <span class="data-label">
                DATA TERKINI
            </span>

        </div>


        <div class="summary-grid">


            {{-- AKTIF --}}

            <div class="summary-card active-card">

                <div class="summary-card-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>

                    </div>

                    <span class="summary-status">
                        AKTIF
                    </span>

                </div>


                <div class="summary-number">
                    {{ $pesertaAktif }}
                </div>


                <div class="summary-label">
                    Peserta sedang PKL
                </div>


                <div class="summary-line"></div>

            </div>


            {{-- SELESAI --}}

            <div class="summary-card completed-card">

                <div class="summary-card-top">

                    <div class="summary-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M8 12l2.5 2.5L16 9"/>
                        </svg>

                    </div>

                    <span class="summary-status">
                        SELESAI
                    </span>

                </div>


                <div class="summary-number">
                    {{ $pesertaSelesai }}
                </div>


                <div class="summary-label">
                    Peserta telah selesai
                </div>


                <div class="summary-line"></div>

            </div>

        </div>

    </section>


    {{-- =====================================================
        QUICK ACTION
    ====================================================== --}}

    <section class="action-section">

        <div class="section-heading">

            <div>

                <span class="section-kicker">
                    AKSES CEPAT
                </span>

                <h2>
                    Kelola Data
                </h2>

            </div>

        </div>


        <div class="action-list">


            {{-- TAMBAH PESERTA --}}

            <a
                href="{{ route('peserta.create') }}"
                class="action-item"
            >

                <div class="action-icon blue">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                    </svg>

                </div>


                <div class="action-content">

                    <strong>
                        Tambah Peserta
                    </strong>

                    <span>
                        Daftarkan peserta PKL baru
                    </span>

                </div>


                <svg
                    class="action-arrow"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M9 18l6-6-6-6"/>
                </svg>

            </a>


            {{-- TAMBAH PERIODE --}}

            <a
                href="{{ route('periode.create') }}"
                class="action-item"
            >

                <div class="action-icon yellow">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path d="M16 2v4"/>
                        <path d="M8 2v4"/>
                        <path d="M3 10h18"/>
                    </svg>

                </div>


                <div class="action-content">

                    <strong>
                        Tambah Periode
                    </strong>

                    <span>
                        Buat periode PKL baru
                    </span>

                </div>


                <svg
                    class="action-arrow"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M9 18l6-6-6-6"/>
                </svg>

            </a>

        </div>

    </section>


    {{-- =====================================================
        PERIODE PKL
    ====================================================== --}}

    <section class="period-section">

        <div class="section-heading period-heading">

            <div>

                <span class="section-kicker">
                    MONITORING KAPASITAS
                </span>

                <h2>
                    Periode PKL
                </h2>

            </div>


            <a
                href="{{ route('periode.index') }}"
                class="view-all"
            >
                Lihat semua
            </a>

        </div>


        @if($periodes->count())

            <div class="period-list">

                @foreach($periodes as $periode)

                    @php

                        $terisi = $periode->peserta_aktif_count;

                        $persentase = $periode->kuota > 0
                            ? min(($terisi / $periode->kuota) * 100, 100)
                            : 0;

                        $penuh = $terisi >= $periode->kuota;

                    @endphp


                    <article class="period-card">


                        <div class="period-card-header">

                            <div class="period-title">

                                <h3>
                                    {{ $periode->nama_periode }}
                                </h3>

                                <span>
                                    {{ $periode->unit_kerja }}
                                </span>

                            </div>


                            @if($penuh)

                                <span class="availability full">
                                    PENUH
                                </span>

                            @else

                                <span class="availability available">
                                    TERSEDIA
                                </span>

                            @endif

                        </div>


                        <div class="period-meta">

                            <div>

                                <span>
                                    Kapasitas
                                </span>

                                <strong>
                                    {{ $terisi }} / {{ $periode->kuota }}
                                </strong>

                            </div>


                            <strong class="percentage">
                                {{ round($persentase) }}%
                            </strong>

                        </div>


                        <div class="progress-track">

                            <div
                                class="progress-value {{ $penuh ? 'danger' : '' }}"
                                style="width: {{ $persentase }}%"
                            ></div>

                        </div>


                        <div class="period-footer">

                            <span>
                                {{ $penuh
                                    ? 'Kuota periode telah terpenuhi'
                                    : ($periode->kuota - $terisi) . ' kuota masih tersedia'
                                }}
                            </span>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="empty-period">

                <div class="empty-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                    >
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path d="M16 2v4"/>
                        <path d="M8 2v4"/>
                        <path d="M3 10h18"/>
                    </svg>

                </div>


                <strong>
                    Belum ada periode PKL
                </strong>

                <p>
                    Tambahkan periode untuk mulai mengelola kapasitas peserta.
                </p>


                <a href="{{ route('periode.create') }}">
                    Tambah Periode
                </a>

            </div>

        @endif

    </section>

</div>


@push('styles')

<style>

    /* =====================================================
       DASHBOARD
    ====================================================== */

    .dashboard {
        padding-bottom: 8px;
    }


    /* =====================================================
       HEADER
    ====================================================== */

    .dashboard-header {

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding-bottom: 17px;

        margin-bottom: 20px;

        border-bottom: 1px solid var(--border);

    }


    .brand-section {

        display: flex;
        align-items: center;

        gap: 10px;

    }


    .institution-mark {

        width: 36px;
        height: 36px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--putr-navy);

        color: var(--putr-yellow);

        border-radius: 7px;

        font-size: 10px;
        font-weight: 800;

        letter-spacing: -.03em;

        border-bottom: 3px solid var(--putr-yellow);

    }


    .institution-info {

        display: flex;
        flex-direction: column;

        line-height: 1.15;

    }


    .institution-name {

        color: var(--putr-navy);

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .055em;

    }


    .institution-subtitle {

        margin-top: 3px;

        color: var(--text-muted);

        font-size: 8px;
        font-weight: 550;

        letter-spacing: .04em;

    }


    .system-status {

        display: flex;
        align-items: center;

        gap: 5px;

        padding: 5px 7px;

        background: #F1F8F4;

        border: 1px solid #D5ECDD;

        border-radius: 5px;

        color: var(--success);

        font-size: 8px;
        font-weight: 650;

    }


    .status-indicator {

        width: 5px;
        height: 5px;

        border-radius: 50%;

        background: var(--success);

    }


    /* =====================================================
       PAGE INTRO
    ====================================================== */

    .page-intro {

        margin-bottom: 25px;

    }


    .eyebrow,
    .section-kicker {

        display: block;

        color: var(--putr-blue);

        font-size: 8px;
        font-weight: 800;

        letter-spacing: .095em;

    }


    .page-intro h1 {

        margin-top: 5px;

        color: var(--putr-navy);

        font-size: 26px;
        line-height: 1.1;

        font-weight: 760;

        letter-spacing: -.025em;

    }


    .page-intro p {

        max-width: 290px;

        margin-top: 6px;

        color: var(--text-secondary);

        font-size: 10px;

    }


    /* =====================================================
       SECTION HEADING
    ====================================================== */

    .section-heading {

        display: flex;
        align-items: flex-end;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 10px;

    }


    .section-heading h2 {

        margin-top: 3px;

        color: var(--text);

        font-size: 15px;
        line-height: 1.2;

        font-weight: 720;

    }


    .data-label {

        color: var(--text-muted);

        font-size: 7px;
        font-weight: 700;

        letter-spacing: .06em;

    }


    /* =====================================================
       SUMMARY
    ====================================================== */

    .summary-section {

        margin-bottom: 25px;

    }


    .summary-grid {

        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 9px;

    }


    .summary-card {

        position: relative;

        min-height: 139px;

        overflow: hidden;

        padding: 14px;

        background: #fff;

        border: 1px solid var(--border);

        border-radius: 10px;

        box-shadow:
            0 3px 9px rgba(16, 42, 67, .035);

    }


    .summary-card::after {

        content: "";

        position: absolute;

        right: -27px;
        bottom: -30px;

        width: 80px;
        height: 80px;

        border-radius: 50%;

        opacity: .7;

    }


    .active-card::after {

        background: #E7F0F8;

    }


    .completed-card::after {

        background: #EAF5ED;

    }


    .summary-card-top {

        position: relative;
        z-index: 1;

        display: flex;
        align-items: center;
        justify-content: space-between;

    }


    .summary-icon {

        width: 31px;
        height: 31px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;

        background: #EDF4FA;

        color: var(--putr-blue);

    }


    .completed-card .summary-icon {

        background: #EDF7F0;

        color: var(--success);

    }


    .summary-icon svg {

        width: 16px;
        height: 16px;

    }


    .summary-status {

        color: var(--text-muted);

        font-size: 7px;
        font-weight: 800;

        letter-spacing: .07em;

    }


    .summary-number {

        position: relative;
        z-index: 1;

        margin-top: 19px;

        color: var(--putr-navy);

        font-size: 28px;
        line-height: 1;

        font-weight: 760;

        letter-spacing: -.035em;

    }


    .summary-label {

        position: relative;
        z-index: 1;

        margin-top: 5px;

        color: var(--text-secondary);

        font-size: 9px;

    }


    .summary-line {

        position: absolute;

        left: 14px;
        bottom: 14px;

        width: 24px;
        height: 2px;

        background: var(--putr-yellow);

        border-radius: 2px;

    }


    .completed-card .summary-line {

        background: #78B98D;

    }


    /* =====================================================
       QUICK ACTION
    ====================================================== */

    .action-section {

        margin-bottom: 27px;

    }


    .action-list {

        display: grid;

        gap: 7px;

    }


    .action-item {

        display: flex;
        align-items: center;

        min-height: 57px;

        padding: 9px 11px;

        background: #fff;

        border: 1px solid var(--border);

        border-radius: 9px;

        text-decoration: none;

        transition:
            border-color .15s ease,
            transform .15s ease,
            box-shadow .15s ease;

    }


    .action-item:hover {

        border-color: #B8C7D6;

        transform: translateY(-1px);

        box-shadow:
            0 5px 13px rgba(16, 42, 67, .055);

    }


    .action-icon {

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;

    }


    .action-icon.blue {

        background: #EAF2F9;

        color: var(--putr-blue);

    }


    .action-icon.yellow {

        background: #FFF6D9;

        color: #936F00;

    }


    .action-icon svg {

        width: 17px;
        height: 17px;

    }


    .action-content {

        min-width: 0;

        margin-left: 10px;

    }


    .action-content strong {

        display: block;

        color: var(--text);

        font-size: 10px;
        font-weight: 700;

    }


    .action-content span {

        display: block;

        margin-top: 2px;

        color: var(--text-muted);

        font-size: 8px;

    }


    .action-arrow {

        width: 14px;
        height: 14px;

        margin-left: auto;

        color: #9FB3C8;

    }


    /* =====================================================
       PERIOD
    ====================================================== */

    .period-section {

        margin-bottom: 15px;

    }


    .period-heading {

        align-items: center;

    }


    .view-all {

        color: var(--putr-blue);

        font-size: 9px;
        font-weight: 700;

        text-decoration: none;

    }


    .period-list {

        display: grid;

        gap: 8px;

    }


    .period-card {

        padding: 14px;

        background: #fff;

        border: 1px solid var(--border);

        border-radius: 10px;

        box-shadow:
            0 3px 9px rgba(16, 42, 67, .03);

    }


    .period-card-header {

        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 10px;

    }


    .period-title {

        min-width: 0;

    }


    .period-title h3 {

        overflow: hidden;

        color: var(--text);

        font-size: 12px;
        font-weight: 700;

        white-space: nowrap;
        text-overflow: ellipsis;

    }


    .period-title span {

        display: block;

        margin-top: 3px;

        color: var(--text-secondary);

        font-size: 9px;

    }


    .availability {

        flex: 0 0 auto;

        padding: 4px 7px;

        border-radius: 4px;

        font-size: 7px;
        font-weight: 800;

        letter-spacing: .035em;

    }


    .availability.available {

        background: var(--success-bg);

        color: var(--success);

    }


    .availability.full {

        background: var(--danger-bg);

        color: var(--danger);

    }


    .period-meta {

        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-top: 17px;
        margin-bottom: 7px;

    }


    .period-meta > div {

        display: flex;
        align-items: center;

        gap: 5px;

    }


    .period-meta span {

        color: var(--text-muted);

        font-size: 8px;

    }


    .period-meta strong {

        color: var(--text-secondary);

        font-size: 8px;
        font-weight: 700;

    }


    .period-meta .percentage {

        color: var(--putr-blue);

        font-size: 9px;
        font-weight: 750;

    }


    .progress-track {

        width: 100%;
        height: 5px;

        overflow: hidden;

        background: #E9EEF3;

        border-radius: 3px;

    }


    .progress-value {

        height: 100%;

        background:
            linear-gradient(
                90deg,
                var(--putr-blue-dark),
                var(--putr-blue)
            );

        border-radius: 3px;

        transition: width .3s ease;

    }


    .progress-value.danger {

        background: var(--danger);

    }


    .period-footer {

        margin-top: 8px;

        color: var(--text-muted);

        font-size: 8px;

    }


    /* =====================================================
       EMPTY STATE
    ====================================================== */

    .empty-period {

        padding: 29px 18px;

        text-align: center;

        background: #fff;

        border: 1px dashed #B8C7D6;

        border-radius: 10px;

    }


    .empty-icon {

        width: 40px;
        height: 40px;

        margin: 0 auto 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #EDF2F6;

        color: var(--text-secondary);

        border-radius: 8px;

    }


    .empty-icon svg {

        width: 18px;
        height: 18px;

    }


    .empty-period strong {

        display: block;

        color: var(--text);

        font-size: 11px;

    }


    .empty-period p {

        max-width: 250px;

        margin: 4px auto 12px;

        color: var(--text-muted);

        font-size: 9px;

    }


    .empty-period a {

        color: var(--putr-blue);

        font-size: 9px;
        font-weight: 700;

        text-decoration: none;

    }


    /* =====================================================
       SMALL DEVICE
    ====================================================== */

    @media (max-width: 360px) {

        .page-intro h1 {
            font-size: 23px;
        }

        .summary-card {
            min-height: 132px;
            padding: 12px;
        }

        .summary-number {
            font-size: 25px;
        }

    }

</style>

@endpush

@endsection