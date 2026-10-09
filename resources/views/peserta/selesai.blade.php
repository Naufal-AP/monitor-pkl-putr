@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <div class="eyebrow">ARSIP ADMINISTRASI</div>
        <h1 class="page-title">Peserta Selesai</h1>
        <p class="page-description">
            Riwayat peserta PKL yang telah menyelesaikan pelaksanaan.
        </p>
    </div>

    <a href="{{ route('peserta.index') }}" class="back-link">
        ← Peserta Aktif
    </a>
</div>

{{-- SUMMARY --}}
<div class="archive-summary">
    <div>
        <span class="summary-label">TOTAL ARSIP</span>
        <strong>{{ $pesertas->count() }}</strong>
        <small>peserta selesai</small>
    </div>

    <div class="archive-mark">
        <span>ARSIP</span>
        <strong>PKL</strong>
    </div>
</div>

{{-- SEARCH --}}
<div class="search-panel">
    <div class="search-heading">
        <div>
            <span class="section-kicker">PENCARIAN DATA</span>
            <h2>Telusuri Arsip</h2>
        </div>

        @if(request('search'))
            <span class="result-tag">
                {{ $pesertas->count() }} hasil
            </span>
        @endif
    </div>

    <form action="{{ route('peserta.selesai.list') }}" method="GET">
        <div class="search-box">
            <span class="search-icon">⌕</span>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama, institusi, atau jurusan..."
                autocomplete="off"
            >

            @if(request('search'))
                <a
                    href="{{ route('peserta.selesai.list') }}"
                    class="search-clear"
                    title="Hapus pencarian"
                >
                    ×
                </a>
            @endif

            <button type="submit">
                Cari
            </button>
        </div>
    </form>
</div>

{{-- LIST --}}
<div class="section-heading archive-heading">
    <div>
        <span class="section-kicker">RIWAYAT PESERTA</span>
        <h2>
            {{ request('search') ? 'Hasil Pencarian' : 'Daftar Peserta Selesai' }}
        </h2>
    </div>

    <span class="section-count">
        {{ $pesertas->count() }} data
    </span>
</div>

@if($pesertas->count())

    <div class="archive-list">

        @foreach($pesertas as $index => $peserta)

            <article class="archive-card">

                {{-- TOP --}}
                <div class="archive-card-top">

                    <div class="archive-number">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    <div class="archive-identity">
                        <h3>{{ $peserta->nama }}</h3>

                        <p>
                            {{ $peserta->institusi }}
                        </p>
                    </div>

                    <span class="status-badge status-completed">
                        SELESAI
                    </span>

                </div>

                {{-- INFO --}}
                <div class="archive-info">

                    <div class="info-item">
                        <span>JURUSAN</span>
                        <strong>{{ $peserta->jurusan }}</strong>
                    </div>

                    <div class="info-item">
                        <span>PEMBIMBING</span>
                        <strong>{{ $peserta->pembimbing }}</strong>
                    </div>

                    <div class="info-item">
                        <span>PERIODE</span>
                        <strong>
                            {{ $peserta->periode->nama_periode ?? '-' }}
                        </strong>
                    </div>

                    <div class="info-item">
                        <span>UNIT KERJA</span>
                        <strong>
                            {{ $peserta->periode->unit_kerja ?? '-' }}
                        </strong>
                    </div>

                </div>

                {{-- PERIOD --}}
                <div class="archive-period">

                    <div>
                        <span>TANGGAL MULAI</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->translatedFormat('d F Y') }}
                        </strong>
                    </div>

                    <div class="period-arrow">
                        →
                    </div>

                    <div>
                        <span>TANGGAL SELESAI</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->translatedFormat('d F Y') }}
                        </strong>
                    </div>

                </div>

                {{-- ACTION --}}
                <div class="archive-actions">

                    <a
                        href="{{ route('peserta.show', $peserta) }}"
                        class="btn btn-outline"
                    >
                        Lihat Detail
                    </a>

                    <a
                        href="{{ route('peserta.edit', $peserta) }}"
                        class="btn btn-outline"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('peserta.destroy', $peserta) }}"
                        method="POST"
                        onsubmit="return confirm('Hapus data peserta ini dari arsip? Data yang dihapus tidak dapat dikembalikan.');"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger-outline">
                            Hapus
                        </button>
                    </form>

                </div>

            </article>

        @endforeach

    </div>

@else

    {{-- EMPTY STATE --}}
    <div class="empty-state archive-empty">

        <div class="empty-mark">
            AR
        </div>

        @if(request('search'))

            <span class="empty-kicker">DATA TIDAK DITEMUKAN</span>

            <h3>Tidak ada hasil pencarian</h3>

            <p>
                Tidak ditemukan peserta selesai dengan kata kunci
                <strong>"{{ request('search') }}"</strong>.
            </p>

            <a
                href="{{ route('peserta.selesai.list') }}"
                class="btn btn-primary"
            >
                Tampilkan Semua Arsip
            </a>

        @else

            <span class="empty-kicker">ARSIP MASIH KOSONG</span>

            <h3>Belum ada peserta selesai</h3>

            <p>
                Peserta yang telah ditandai selesai akan otomatis masuk
                ke halaman arsip ini.
            </p>

            <a
                href="{{ route('peserta.index') }}"
                class="btn btn-primary"
            >
                Lihat Peserta Aktif
            </a>

        @endif

    </div>

@endif

<style>
    /* ================================
       ARCHIVE PAGE
       ================================ */

    .archive-summary {
        display: flex;
        align-items: stretch;
        justify-content: space-between;
        margin: 18px 0;
        border: 1px solid var(--putr-border);
        background: #ffffff;
        min-height: 110px;
    }

    .archive-summary > div:first-child {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .summary-label {
        display: block;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .12em;
        color: var(--putr-muted);
        margin-bottom: 5px;
    }

    .archive-summary strong {
        font-size: 34px;
        line-height: 1;
        color: var(--putr-navy);
        letter-spacing: -.04em;
    }

    .archive-summary small {
        margin-top: 6px;
        color: var(--putr-muted);
        font-size: 12px;
    }

    .archive-mark {
        min-width: 105px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        background: #F5F7FA;
        border-left: 1px solid var(--putr-border);
    }

    .archive-mark span {
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .12em;
        color: var(--putr-muted);
    }

    .archive-mark strong {
        font-size: 20px;
        margin-top: 3px;
    }


    /* SEARCH */

    .search-panel {
        margin-top: 18px;
        padding: 16px;
        border: 1px solid var(--putr-border);
        background: #ffffff;
    }

    .search-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 13px;
    }

    .search-heading h2 {
        margin: 3px 0 0;
        font-size: 17px;
        color: var(--putr-navy);
    }

    .section-kicker {
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .13em;
        color: var(--putr-muted);
    }

    .result-tag {
        padding: 6px 9px;
        background: #F3F5F7;
        color: var(--putr-muted);
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .search-box {
        display: flex;
        align-items: center;
        border: 1px solid #C9D2DC;
        background: #fff;
        min-height: 44px;
    }

    .search-box:focus-within {
        border-color: var(--putr-blue);
        box-shadow: 0 0 0 2px rgba(23, 105, 170, .08);
    }

    .search-icon {
        width: 40px;
        text-align: center;
        color: var(--putr-muted);
        font-size: 21px;
        line-height: 1;
    }

    .search-box input {
        flex: 1;
        min-width: 0;
        border: 0;
        outline: 0;
        background: transparent;
        padding: 11px 4px;
        font-size: 13px;
        color: var(--putr-text);
        font-family: inherit;
    }

    .search-box input::placeholder {
        color: #9AA5B1;
    }

    .search-box button {
        height: 32px;
        margin-right: 6px;
        padding: 0 13px;
        border: 0;
        background: var(--putr-navy);
        color: #fff;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
    }

    .search-clear {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        color: var(--putr-muted);
        text-decoration: none;
        font-size: 20px;
    }


    /* SECTION */

    .archive-heading {
        margin-top: 28px;
    }

    .section-count {
        font-size: 10px;
        font-weight: 700;
        color: var(--putr-muted);
        white-space: nowrap;
    }


    /* ARCHIVE CARD */

    .archive-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .archive-card {
        border: 1px solid var(--putr-border);
        background: #ffffff;
    }

    .archive-card-top {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px;
        border-bottom: 1px solid var(--putr-border);
    }

    .archive-number {
        flex: 0 0 34px;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F3F5F7;
        color: var(--putr-muted);
        font-size: 10px;
        font-weight: 800;
    }

    .archive-identity {
        min-width: 0;
        flex: 1;
    }

    .archive-identity h3 {
        margin: 1px 0 3px;
        font-size: 14px;
        line-height: 1.35;
        color: var(--putr-navy);
    }

    .archive-identity p {
        margin: 0;
        color: var(--putr-muted);
        font-size: 11px;
        line-height: 1.4;
    }

    .status-completed {
        flex-shrink: 0;
        background: #EDF7F0;
        color: #247A45;
        border-color: #CBE8D4;
    }


    /* INFO */

    .archive-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        border-bottom: 1px solid var(--putr-border);
    }

    .info-item {
        min-width: 0;
        padding: 12px 14px;
        border-bottom: 1px solid #EEF1F4;
    }

    .info-item:nth-child(odd) {
        border-right: 1px solid #EEF1F4;
    }

    .info-item:nth-last-child(-n+2) {
        border-bottom: 0;
    }

    .info-item span,
    .archive-period span {
        display: block;
        margin-bottom: 4px;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .11em;
        color: var(--putr-muted);
    }

    .info-item strong {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 11px;
        line-height: 1.4;
        color: var(--putr-text);
    }


    /* DATE */

    .archive-period {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 12px;
        padding: 13px 14px;
        background: #FAFBFC;
        border-bottom: 1px solid var(--putr-border);
    }

    .archive-period strong {
        font-size: 11px;
        color: var(--putr-navy);
    }

    .period-arrow {
        color: var(--putr-muted);
        font-size: 15px;
    }


    /* ACTION */

    .archive-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 12px 14px;
    }

    .archive-actions .btn {
        flex: 1;
        min-height: 34px;
        font-size: 10px;
        padding: 7px 9px;
    }

    .archive-actions form {
        flex: 1;
        margin: 0;
    }

    .archive-actions form .btn {
        width: 100%;
    }

    .btn-danger-outline {
        border: 1px solid #E3B9B9;
        background: #fff;
        color: #A63D3D;
        cursor: pointer;
    }

    .btn-danger-outline:hover {
        background: #FFF5F5;
    }


    /* EMPTY */

    .archive-empty {
        margin-top: 16px;
        padding: 42px 22px;
        border: 1px solid var(--putr-border);
        background: #ffffff;
        text-align: center;
    }

    .empty-mark {
        width: 48px;
        height: 48px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F1F4F7;
        color: var(--putr-navy);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .08em;
    }

    .empty-kicker {
        display: block;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .13em;
        color: var(--putr-muted);
        margin-bottom: 7px;
    }

    .archive-empty h3 {
        margin: 0;
        color: var(--putr-navy);
        font-size: 16px;
    }

    .archive-empty p {
        max-width: 320px;
        margin: 8px auto 18px;
        color: var(--putr-muted);
        font-size: 11px;
        line-height: 1.6;
    }


    /* MOBILE */

    @media (max-width: 360px) {

        .archive-card-top {
            flex-wrap: wrap;
        }

        .status-completed {
            margin-left: 45px;
        }

        .archive-actions {
            flex-wrap: wrap;
        }

        .archive-actions .btn,
        .archive-actions form {
            flex: 1 1 calc(50% - 4px);
        }

        .archive-actions form:last-child {
            flex-basis: 100%;
        }

        .archive-period {
            gap: 7px;
        }

        .archive-period strong {
            font-size: 10px;
        }

    }
</style>

@endsection