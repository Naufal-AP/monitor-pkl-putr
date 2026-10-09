@extends('layouts.app')

@section('title', 'Detail Peserta')

@section('content')

<div class="detail-page">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <header class="detail-header">

        <a
            href="{{ route('peserta.index') }}"
            class="back-link"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M19 12H5"/>
                <path d="M12 19l-7-7 7-7"/>
            </svg>
        </a>


        <div class="header-content">

            <span class="page-kicker">
                DATA PESERTA
            </span>

            <h1>
                Detail Peserta
            </h1>

            <p>
                Informasi lengkap peserta praktik kerja lapangan.
            </p>

        </div>


        <span class="record-id">
            #{{ str_pad($peserta->id, 4, '0', STR_PAD_LEFT) }}
        </span>

    </header>


    {{-- =====================================================
        PROFILE / STATUS
    ====================================================== --}}

    <section class="profile-card">

        <div class="profile-top">

            <div class="profile-mark">
                {{ strtoupper(substr($peserta->nama, 0, 1)) }}
            </div>


            <div class="profile-main">

                <span class="profile-label">
                    PESERTA PKL
                </span>

                <h2>
                    {{ $peserta->nama }}
                </h2>

                <p>
                    {{ $peserta->institusi }}
                </p>

            </div>


            @if($peserta->status === 'aktif')

                <span class="status-badge active">
                    AKTIF
                </span>

            @else

                <span class="status-badge completed">
                    SELESAI
                </span>

            @endif

        </div>


        <div class="profile-divider"></div>


        <div class="profile-meta">

            <div>

                <span>
                    PROGRAM STUDI
                </span>

                <strong>
                    {{ $peserta->jurusan }}
                </strong>

            </div>


            <div>

                <span>
                    PEMBIMBING
                </span>

                <strong>
                    {{ $peserta->pembimbing }}
                </strong>

            </div>

        </div>

    </section>


    {{-- =====================================================
        PERIOD
    ====================================================== --}}

    <section class="information-section">

        <div class="section-heading">

            <div>

                <span class="section-kicker">
                    PENEMPATAN
                </span>

                <h2>
                    Periode PKL
                </h2>

            </div>

        </div>


        <div class="period-detail-card">

            <div class="period-icon">

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


            <div class="period-detail-content">

                <span>
                    PERIODE TERDAFTAR
                </span>

                <strong>
                    {{ $peserta->periode->nama_periode }}
                </strong>

                <small>
                    {{ $peserta->periode->unit_kerja }}
                </small>

            </div>

        </div>

    </section>


    {{-- =====================================================
        TIME
    ====================================================== --}}

    <section class="information-section">

        <div class="section-heading">

            <div>

                <span class="section-kicker">
                    PELAKSANAAN
                </span>

                <h2>
                    Jadwal PKL
                </h2>

            </div>

        </div>


        <div class="schedule-card">

            <div class="schedule-item">

                <span>
                    TANGGAL MULAI
                </span>

                <strong>
                    {{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->translatedFormat('d F Y') }}
                </strong>

            </div>


            <div class="schedule-line">

                <span></span>

            </div>


            <div class="schedule-item end">

                <span>
                    TANGGAL SELESAI
                </span>

                <strong>
                    {{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->translatedFormat('d F Y') }}
                </strong>

            </div>

        </div>

    </section>


    {{-- =====================================================
        ADMINISTRATIVE INFORMATION
    ====================================================== --}}

    <section class="information-section">

        <div class="section-heading">

            <div>

                <span class="section-kicker">
                    INFORMASI SISTEM
                </span>

                <h2>
                    Administrasi
                </h2>

            </div>

        </div>


        <div class="administrative-card">

            <div class="admin-row">

                <span>
                    Status Data
                </span>

                <strong>
                    {{ $peserta->status === 'aktif'
                        ? 'Sedang melaksanakan PKL'
                        : 'PKL telah selesai'
                    }}
                </strong>

            </div>


            <div class="admin-row">

                <span>
                    Data Dibuat
                </span>

                <strong>
                    {{ $peserta->created_at
                        ? $peserta->created_at->translatedFormat('d F Y, H:i')
                        : '-'
                    }}
                </strong>

            </div>


            <div class="admin-row">

                <span>
                    Pembaruan Terakhir
                </span>

                <strong>
                    {{ $peserta->updated_at
                        ? $peserta->updated_at->translatedFormat('d F Y, H:i')
                        : '-'
                    }}
                </strong>

            </div>

        </div>

    </section>


    {{-- =====================================================
        ACTION
    ====================================================== --}}

    <section class="detail-actions">

        <a
            href="{{ route('peserta.edit', $peserta) }}"
            class="edit-action"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path d="M12 20h9"/>
                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
            </svg>

            Edit Data

        </a>


        @if($peserta->status === 'aktif')

            <form
                action="{{ route('peserta.selesai', $peserta) }}"
                method="POST"
                onsubmit="return confirm('Tandai peserta ini sebagai selesai?')"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="complete-action"
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12l2.5 2.5L16 9"/>
                    </svg>

                    Tandai Selesai

                </button>

            </form>

        @endif

    </section>


    {{-- DELETE --}}
    <section class="danger-zone">

        <form
            action="{{ route('peserta.destroy', $peserta) }}"
            method="POST"
            onsubmit="return confirm('Hapus data peserta ini secara permanen? Tindakan ini tidak dapat dibatalkan.')"
        >

            @csrf
            @method('DELETE')

            <button type="submit">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                >
                    <path d="M3 6h18"/>
                    <path d="M8 6V4h8v2"/>
                    <path d="M19 6l-1 15H6L5 6"/>
                    <path d="M10 11v6"/>
                    <path d="M14 11v6"/>
                </svg>

                Hapus Data Peserta

            </button>

        </form>

    </section>

</div>


@push('styles')

<style>

    /* =====================================================
       PAGE
    ====================================================== */

    .detail-page {
        padding-bottom: 12px;
    }


    /* =====================================================
       HEADER
    ====================================================== */

    .detail-header {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        padding-bottom: 16px;

        margin-bottom: 13px;

        border-bottom: 1px solid var(--border);
    }


    .back-link {
        width: 30px;
        height: 30px;

        flex: 0 0 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid var(--border);

        border-radius: 7px;

        background: #fff;

        color: var(--text-secondary);

        text-decoration: none;
    }


    .back-link svg {
        width: 15px;
        height: 15px;
    }


    .header-content {
        min-width: 0;
    }


    .page-kicker {
        display: block;

        color: var(--putr-blue);

        font-size: 7px;
        font-weight: 800;

        letter-spacing: .09em;
    }


    .detail-header h1 {
        margin-top: 3px;

        color: var(--putr-navy);

        font-size: 21px;
        line-height: 1.15;

        font-weight: 750;

        letter-spacing: -.02em;
    }


    .detail-header p {
        margin-top: 4px;

        color: var(--text-muted);

        font-size: 8px;
    }


    .record-id {
        margin-left: auto;

        flex: 0 0 auto;

        padding: 5px 7px;

        border: 1px solid var(--border);

        border-radius: 5px;

        background: #F8FAFB;

        color: var(--text-muted);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .04em;
    }


    /* =====================================================
       PROFILE
    ====================================================== */

    .profile-card {
        padding: 15px;

        background: #fff;

        border: 1px solid var(--border);

        border-top: 3px solid var(--putr-yellow);

        border-radius: 9px;

        box-shadow:
            0 4px 10px rgba(16, 42, 67, .035);
    }


    .profile-top {
        display: flex;
        align-items: flex-start;

        gap: 10px;
    }


    .profile-mark {
        width: 43px;
        height: 43px;

        flex: 0 0 43px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--putr-navy);

        color: var(--putr-yellow);

        border-radius: 8px;

        font-size: 16px;
        font-weight: 800;
    }


    .profile-main {
        min-width: 0;
    }


    .profile-label {
        display: block;

        color: var(--text-muted);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .08em;
    }


    .profile-main h2 {
        overflow: hidden;

        margin-top: 3px;

        color: var(--text);

        font-size: 14px;
        line-height: 1.25;

        font-weight: 750;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .profile-main p {
        overflow: hidden;

        margin-top: 2px;

        color: var(--text-secondary);

        font-size: 8px;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .profile-top .status-badge {
        margin-left: auto;

        flex: 0 0 auto;
    }


    .status-badge {
        display: inline-flex;
        align-items: center;

        gap: 4px;

        padding: 5px 7px;

        border-radius: 5px;

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .045em;
    }


    .status-badge::before {
        content: "";

        width: 4px;
        height: 4px;

        border-radius: 50%;
    }


    .status-badge.active {
        background: var(--success-bg);

        color: var(--success);
    }


    .status-badge.active::before {
        background: var(--success);
    }


    .status-badge.completed {
        background: #EEF2F6;

        color: var(--text-secondary);
    }


    .status-badge.completed::before {
        background: var(--text-muted);
    }


    .profile-divider {
        height: 1px;

        margin: 13px 0;

        background: #EDF1F4;
    }


    .profile-meta {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 12px;
    }


    .profile-meta > div {
        min-width: 0;
    }


    .profile-meta span {
        display: block;

        color: var(--text-muted);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .06em;
    }


    .profile-meta strong {
        display: block;

        overflow: hidden;

        margin-top: 3px;

        color: var(--text-secondary);

        font-size: 8px;
        font-weight: 650;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    /* =====================================================
       SECTION
    ====================================================== */

    .information-section {
        margin-top: 20px;
    }


    .section-heading {
        margin-bottom: 9px;
    }


    .section-kicker {
        display: block;

        color: var(--putr-blue);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .09em;
    }


    .section-heading h2 {
        margin-top: 3px;

        color: var(--text);

        font-size: 13px;
        font-weight: 720;
    }


    /* =====================================================
       PERIOD
    ====================================================== */

    .period-detail-card {
        display: flex;
        align-items: center;

        gap: 10px;

        padding: 13px;

        background: #fff;

        border: 1px solid var(--border);

        border-radius: 8px;
    }


    .period-icon {
        width: 35px;
        height: 35px;

        flex: 0 0 35px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #EDF4FA;

        color: var(--putr-blue);

        border-radius: 7px;
    }


    .period-icon svg {
        width: 17px;
        height: 17px;
    }


    .period-detail-content {
        min-width: 0;

        display: flex;
        flex-direction: column;
    }


    .period-detail-content span {
        color: var(--text-muted);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .07em;
    }


    .period-detail-content strong {
        overflow: hidden;

        margin-top: 3px;

        color: var(--text);

        font-size: 10px;
        font-weight: 700;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .period-detail-content small {
        margin-top: 2px;

        color: var(--text-secondary);

        font-size: 7px;
    }


    /* =====================================================
       SCHEDULE
    ====================================================== */

    .schedule-card {
        display: flex;
        align-items: center;

        padding: 13px;

        background: #fff;

        border: 1px solid var(--border);

        border-radius: 8px;
    }


    .schedule-item {
        flex: 1;

        min-width: 0;
    }


    .schedule-item span {
        display: block;

        color: var(--text-muted);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .07em;
    }


    .schedule-item strong {
        display: block;

        margin-top: 4px;

        color: var(--text);

        font-size: 9px;
        font-weight: 700;
    }


    .schedule-item.end {
        text-align: right;
    }


    .schedule-line {
        position: relative;

        width: 46px;
        height: 12px;

        flex: 0 0 46px;

        margin: 0 8px;
    }


    .schedule-line::before {
        content: "";

        position: absolute;

        left: 0;
        right: 0;
        top: 50%;

        height: 1px;

        background: #CCD7E0;
    }


    .schedule-line span {
        position: absolute;

        left: 50%;
        top: 50%;

        width: 6px;
        height: 6px;

        transform: translate(-50%, -50%);

        border: 2px solid #fff;

        border-radius: 50%;

        background: var(--putr-yellow);

        box-shadow:
            0 0 0 1px #D8C36B;
    }


    /* =====================================================
       ADMINISTRATIVE
    ====================================================== */

    .administrative-card {
        background: #fff;

        border: 1px solid var(--border);

        border-radius: 8px;

        overflow: hidden;
    }


    .admin-row {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        min-height: 39px;

        padding: 0 12px;

        border-bottom: 1px solid #EDF1F4;
    }


    .admin-row:last-child {
        border-bottom: 0;
    }


    .admin-row span {
        color: var(--text-muted);

        font-size: 8px;
    }


    .admin-row strong {
        max-width: 63%;

        overflow: hidden;

        color: var(--text-secondary);

        font-size: 8px;
        font-weight: 650;

        text-align: right;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    /* =====================================================
       ACTION
    ====================================================== */

    .detail-actions {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 7px;

        margin-top: 20px;
    }


    .detail-actions a,
    .detail-actions form,
    .detail-actions button {
        width: 100%;
    }


    .edit-action,
    .complete-action {
        min-height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 6px;

        border-radius: 7px;

        font-size: 9px;
        font-weight: 700;

        text-decoration: none;

        cursor: pointer;
    }


    .edit-action {
        border: 1px solid #D5E4EF;

        background: #EDF4FA;

        color: var(--putr-blue);
    }


    .complete-action {
        border: 1px solid #CFE5D6;

        background: var(--success-bg);

        color: var(--success);
    }


    .edit-action svg,
    .complete-action svg {
        width: 14px;
        height: 14px;
    }


    /* =====================================================
       DANGER
    ====================================================== */

    .danger-zone {
        margin-top: 12px;

        text-align: center;
    }


    .danger-zone form {
        margin: 0;
    }


    .danger-zone button {
        display: inline-flex;
        align-items: center;

        gap: 5px;

        padding: 5px;

        border: 0;

        background: transparent;

        color: #A85A55;

        font-size: 7px;
        font-weight: 600;

        cursor: pointer;
    }


    .danger-zone button svg {
        width: 11px;
        height: 11px;
    }


    /* =====================================================
       SMALL SCREEN
    ====================================================== */

    @media (max-width: 360px) {

        .record-id {
            display: none;
        }

        .profile-top .status-badge {
            display: none;
        }

        .profile-meta {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .schedule-line {
            width: 25px;
            flex-basis: 25px;
            margin: 0 5px;
        }

    }

</style>

@endpush

@endsection