@extends('layouts.app')

@section('title', 'Peserta PKL')

@section('content')

<div class="peserta-page">

    {{-- HEADER --}}
    <header class="page-header">

        <div class="page-header-main">

            <a href="{{ url('/') }}" class="back-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M19 12H5"/>
                    <path d="M12 19l-7-7 7-7"/>
                </svg>
            </a>

            <div>
                <span class="page-kicker">DATA ADMINISTRASI</span>

                <h1>Peserta PKL</h1>

                <p>
                    Daftar peserta praktik kerja lapangan yang sedang aktif.
                </p>
            </div>

        </div>

        <a
            href="{{ route('peserta.create') }}"
            class="add-button"
            aria-label="Tambah peserta"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9">
                <path d="M12 5v14"/>
                <path d="M5 12h14"/>
            </svg>

            <span>Tambah</span>
        </a>

    </header>


    {{-- SUMMARY STRIP --}}
    <section class="data-summary">

        <div class="summary-main">

            <span class="summary-label">
                PESERTA AKTIF
            </span>

            <strong>
                {{ $pesertas->count() }}
            </strong>

        </div>

        <div class="summary-divider"></div>

        <div class="summary-note">

            <span class="summary-dot"></span>

            <span>
                Sedang melaksanakan PKL
            </span>

        </div>

    </section>


    {{-- SEARCH --}}
    <form
        action="{{ route('peserta.index') }}"
        method="GET"
        class="search-box"
    >

        <div class="search-input">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <circle cx="11" cy="11" r="7"/>
                <path d="m20 20-4-4"/>
            </svg>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, institusi, atau jurusan..."
                autocomplete="off"
            >

            @if(request('search'))

                <a
                    href="{{ route('peserta.index') }}"
                    class="clear-search"
                    aria-label="Hapus pencarian"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 6l12 12"/>
                        <path d="M18 6L6 18"/>
                    </svg>
                </a>

            @endif

        </div>


        <button
            type="submit"
            class="search-button"
        >
            Cari
        </button>

    </form>


    {{-- RESULT INFO --}}
    <div class="result-bar">

        <span>
            @if(request('search'))
                Hasil pencarian untuk
                <strong>"{{ request('search') }}"</strong>
            @else
                Daftar peserta aktif
            @endif
        </span>

        <span class="result-count">
            {{ $pesertas->count() }} data
        </span>

    </div>


    {{-- PESERTA --}}
    @if($pesertas->count())

        <section class="participant-list">

            @foreach($pesertas as $peserta)

                <article class="participant-card">

                    {{-- CARD HEADER --}}
                    <div class="participant-top">

                        <div class="participant-identity">

                            <div class="participant-index">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            <div class="participant-name">

                                <h2>
                                    {{ $peserta->nama }}
                                </h2>

                                <span>
                                    {{ $peserta->institusi }}
                                </span>

                            </div>

                        </div>


                        <span class="active-badge">
                            AKTIF
                        </span>

                    </div>


                    {{-- DETAIL --}}
                    <div class="participant-details">

                        <div class="detail-row">

                            <span class="detail-label">
                                Jurusan
                            </span>

                            <strong>
                                {{ $peserta->jurusan }}
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Pembimbing
                            </span>

                            <strong>
                                {{ $peserta->pembimbing }}
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Periode
                            </span>

                            <strong>
                                {{ $peserta->periode->nama_periode }}
                            </strong>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Pelaksanaan
                            </span>

                            <strong>
                                {{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->translatedFormat('d M Y') }}
                                –
                                {{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->translatedFormat('d M Y') }}
                            </strong>

                        </div>

                    </div>


                    {{-- ACTION --}}
                    <div class="participant-actions">

                        <a
                            href="{{ route('peserta.show', $peserta) }}"
                            class="detail-button"
                        >
                            Lihat Detail
                        </a>


                        <a
                            href="{{ route('peserta.edit', $peserta) }}"
                            class="edit-button"
                        >
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 20h9"/>
                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                            </svg>

                            Edit
                        </a>


                        <form
                            action="{{ route('peserta.selesai', $peserta) }}"
                            method="POST"
                            class="finish-form"
                            onsubmit="return confirm('Tandai peserta ini sebagai selesai?')"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="finish-button"
                                title="Tandai selesai"
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M8 12l2.5 2.5L16 9"/>
                                </svg>
                            </button>

                        </form>

                    </div>

                </article>

            @endforeach

        </section>

    @else

        {{-- EMPTY STATE --}}

        <section class="empty-state">

            <div class="empty-state-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M19 8v6"/>
                    <path d="M16 11h6"/>
                </svg>

            </div>

            @if(request('search'))

                <h2>
                    Data tidak ditemukan
                </h2>

                <p>
                    Tidak ada peserta yang sesuai dengan kata pencarian tersebut.
                </p>

                <a href="{{ route('peserta.index') }}">
                    Tampilkan semua peserta
                </a>

            @else

                <h2>
                    Belum ada peserta aktif
                </h2>

                <p>
                    Data peserta yang sedang melaksanakan PKL akan ditampilkan di sini.
                </p>

                <a href="{{ route('peserta.create') }}">
                    Tambah peserta

                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                    </svg>
                </a>

            @endif

        </section>

    @endif

</div>


@push('styles')

<style>

    /* =====================================================
       PAGE
    ====================================================== */

    .peserta-page {
        padding-bottom: 8px;
    }


    /* =====================================================
       HEADER
    ====================================================== */

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        padding-bottom: 17px;

        margin-bottom: 17px;

        border-bottom: 1px solid var(--border);
    }


    .page-header-main {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        min-width: 0;
    }


    .back-link {
        width: 30px;
        height: 30px;

        flex: 0 0 30px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-top: 1px;

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


    .page-kicker {
        display: block;

        color: var(--putr-blue);

        font-size: 7px;
        font-weight: 800;

        letter-spacing: .09em;
    }


    .page-header h1 {
        margin-top: 3px;

        color: var(--putr-navy);

        font-size: 21px;
        line-height: 1.15;

        font-weight: 750;

        letter-spacing: -.02em;
    }


    .page-header p {
        margin-top: 4px;

        color: var(--text-muted);

        font-size: 8px;
    }


    .add-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 5px;

        min-height: 34px;

        padding: 0 10px;

        flex: 0 0 auto;

        border-radius: 7px;

        background: var(--putr-navy);

        color: #fff;

        font-size: 9px;
        font-weight: 650;

        text-decoration: none;
    }


    .add-button svg {
        width: 13px;
        height: 13px;
    }


    /* =====================================================
       DATA SUMMARY
    ====================================================== */

    .data-summary {
        display: flex;
        align-items: center;

        min-height: 61px;

        margin-bottom: 15px;

        padding: 11px 13px;

        background: #fff;

        border: 1px solid var(--border);
        border-left: 3px solid var(--putr-yellow);

        border-radius: 8px;

        box-shadow:
            0 3px 8px rgba(16, 42, 67, .025);
    }


    .summary-main {
        display: flex;
        flex-direction: column;

        gap: 1px;
    }


    .summary-label {
        color: var(--text-muted);

        font-size: 7px;
        font-weight: 800;

        letter-spacing: .07em;
    }


    .summary-main strong {
        color: var(--putr-navy);

        font-size: 20px;
        line-height: 1;

        font-weight: 760;
    }


    .summary-divider {
        width: 1px;
        height: 28px;

        margin: 0 13px;

        background: var(--border);
    }


    .summary-note {
        display: flex;
        align-items: center;

        gap: 6px;

        color: var(--text-secondary);

        font-size: 8px;
    }


    .summary-dot {
        width: 6px;
        height: 6px;

        border-radius: 50%;

        background: var(--success);

        box-shadow:
            0 0 0 3px var(--success-bg);
    }


    /* =====================================================
       SEARCH
    ====================================================== */

    .search-box {
        display: flex;

        gap: 6px;

        margin-bottom: 10px;
    }


    .search-input {
        position: relative;

        flex: 1;

        min-width: 0;
    }


    .search-input > svg {
        position: absolute;

        left: 11px;
        top: 50%;

        width: 14px;
        height: 14px;

        transform: translateY(-50%);

        color: var(--text-muted);

        pointer-events: none;
    }


    .search-input input {
        width: 100%;

        height: 39px;

        padding: 0 33px;

        border: 1px solid var(--border);
        border-radius: 7px;

        background: #fff;

        color: var(--text);

        font-size: 10px;

        outline: none;
    }


    .search-input input::placeholder {
        color: #9FB3C8;
    }


    .search-input input:focus {
        border-color: var(--putr-blue);

        box-shadow:
            0 0 0 3px rgba(23, 105, 170, .07);
    }


    .clear-search {
        position: absolute;

        right: 8px;
        top: 50%;

        width: 20px;
        height: 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        transform: translateY(-50%);

        color: var(--text-muted);
    }


    .clear-search svg {
        width: 12px;
        height: 12px;
    }


    .search-button {
        width: 43px;
        height: 39px;

        border: 0;
        border-radius: 7px;

        background: var(--putr-navy);

        color: #fff;

        font-size: 9px;
        font-weight: 650;

        cursor: pointer;
    }


    /* =====================================================
       RESULT BAR
    ====================================================== */

    .result-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 8px;

        color: var(--text-muted);

        font-size: 8px;
    }


    .result-bar strong {
        color: var(--text-secondary);

        font-weight: 700;
    }


    .result-count {
        flex: 0 0 auto;

        color: var(--putr-blue);

        font-weight: 700;
    }


    /* =====================================================
       PARTICIPANT CARD
    ====================================================== */

    .participant-list {
        display: grid;

        gap: 8px;
    }


    .participant-card {
        background: #fff;

        border: 1px solid var(--border);

        border-radius: 9px;

        overflow: hidden;

        box-shadow:
            0 3px 9px rgba(16, 42, 67, .025);
    }


    .participant-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 10px;

        padding: 13px 13px 11px;
    }


    .participant-identity {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        min-width: 0;
    }


    .participant-index {
        width: 27px;
        height: 27px;

        flex: 0 0 27px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #EDF3F8;

        color: var(--putr-blue);

        border-radius: 6px;

        font-size: 8px;
        font-weight: 800;

        letter-spacing: .02em;
    }


    .participant-name {
        min-width: 0;
    }


    .participant-name h2 {
        overflow: hidden;

        color: var(--text);

        font-size: 11px;
        line-height: 1.3;

        font-weight: 720;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .participant-name span {
        display: block;

        overflow: hidden;

        margin-top: 2px;

        color: var(--text-secondary);

        font-size: 8px;

        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .active-badge {
        flex: 0 0 auto;

        padding: 4px 6px;

        background: var(--success-bg);

        color: var(--success);

        border-radius: 4px;

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .045em;
    }


    /* =====================================================
       DETAILS
    ====================================================== */

    .participant-details {
        padding: 0 13px;

        border-top: 1px solid #EEF2F5;
        border-bottom: 1px solid #EEF2F5;
    }


    .detail-row {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        min-height: 30px;

        border-bottom: 1px solid #F0F3F6;
    }


    .detail-row:last-child {
        border-bottom: 0;
    }


    .detail-label {
        flex: 0 0 auto;

        color: var(--text-muted);

        font-size: 8px;
    }


    .detail-row strong {
        max-width: 66%;

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

    .participant-actions {
        display: flex;
        align-items: center;

        gap: 6px;

        padding: 9px 13px;
    }


    .detail-button,
    .edit-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 29px;

        padding: 0 9px;

        border-radius: 6px;

        font-size: 8px;
        font-weight: 650;

        text-decoration: none;
    }


    .detail-button {
        flex: 1;

        background: #F1F5F8;

        color: var(--text-secondary);

        border: 1px solid #E1E8EE;
    }


    .edit-button {
        gap: 4px;

        background: #EDF4FA;

        color: var(--putr-blue);

        border: 1px solid #D9E7F2;
    }


    .edit-button svg {
        width: 11px;
        height: 11px;
    }


    .finish-form {
        margin: 0;
    }


    .finish-button {
        width: 29px;
        height: 29px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #D4E9DA;
        border-radius: 6px;

        background: var(--success-bg);

        color: var(--success);

        cursor: pointer;
    }


    .finish-button svg {
        width: 13px;
        height: 13px;
    }


    /* =====================================================
       EMPTY
    ====================================================== */

    .empty-state {
        padding: 34px 18px;

        text-align: center;

        background: #fff;

        border: 1px dashed #B8C7D6;

        border-radius: 10px;
    }


    .empty-state-icon {
        width: 43px;
        height: 43px;

        margin: 0 auto 11px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        background: #EDF2F6;

        color: var(--text-secondary);
    }


    .empty-state-icon svg {
        width: 20px;
        height: 20px;
    }


    .empty-state h2 {
        color: var(--text);

        font-size: 12px;
        font-weight: 700;
    }


    .empty-state p {
        max-width: 270px;

        margin: 5px auto 12px;

        color: var(--text-muted);

        font-size: 9px;
    }


    .empty-state a {
        display: inline-flex;
        align-items: center;

        gap: 4px;

        color: var(--putr-blue);

        font-size: 9px;
        font-weight: 700;

        text-decoration: none;
    }


    .empty-state a svg {
        width: 11px;
        height: 11px;
    }


    /* =====================================================
       SMALL SCREEN
    ====================================================== */

    @media (max-width: 360px) {

        .page-header h1 {
            font-size: 19px;
        }

        .add-button span {
            display: none;
        }

        .add-button {
            width: 34px;
            padding: 0;
        }

        .participant-actions {
            gap: 5px;
        }

        .detail-button,
        .edit-button {
            padding-left: 7px;
            padding-right: 7px;
        }

    }

</style>

@endpush

@endsection