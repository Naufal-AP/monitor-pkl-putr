@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <div class="eyebrow">ADMINISTRASI PKL</div>
        <h1 class="page-title">Periode PKL</h1>
        <p class="page-description">
            Pengaturan periode, unit kerja, dan kapasitas peserta praktik kerja lapangan.
        </p>
    </div>

    <a href="{{ route('periode.create') }}" class="btn btn-primary">
        + Periode Baru
    </a>
</div>

{{-- SUMMARY --}}
<div class="period-summary">

    <div class="period-summary-main">
        <span class="summary-label">TOTAL PERIODE</span>

        <strong>{{ $periodes->count() }}</strong>

        <small>
            periode terdaftar dalam sistem
        </small>
    </div>

    <div class="period-summary-side">
        <span>STATUS</span>

        <strong>AKTIF</strong>

        <small>
            Manajemen kuota
        </small>
    </div>

</div>


{{-- SECTION --}}
<div class="section-heading">
    <div>
        <span class="section-kicker">DAFTAR PERIODE</span>
        <h2>Pengelolaan Kuota</h2>
    </div>

    <span class="section-count">
        {{ $periodes->count() }} periode
    </span>
</div>


@if($periodes->count())

<div class="period-list">

    @foreach($periodes as $index => $periode)

        @php
            $terisi = $periode->peserta()
                ->where('status', 'aktif')
                ->count();

            $tersedia = max($periode->kuota - $terisi, 0);

            $persentase = $periode->kuota > 0
                ? min(($terisi / $periode->kuota) * 100, 100)
                : 0;

            $isFull = $terisi >= $periode->kuota;
        @endphp


        <article class="period-card">

            {{-- CARD HEADER --}}
            <div class="period-card-header">

                <div class="period-index">
                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                </div>

                <div class="period-title">
                    <span>PERIODE</span>

                    <h3>
                        {{ $periode->nama_periode }}
                    </h3>
                </div>

                @if($isFull)

                    <span class="quota-status quota-full">
                        PENUH
                    </span>

                @else

                    <span class="quota-status quota-available">
                        TERSEDIA
                    </span>

                @endif

            </div>


            {{-- UNIT KERJA --}}
            <div class="period-unit">

                <span>UNIT KERJA</span>

                <strong>
                    {{ $periode->unit_kerja }}
                </strong>

            </div>


            {{-- DATE --}}
            <div class="period-date">

                <div>
                    <span>MULAI</span>

                    <strong>
                        {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->translatedFormat('d M Y') }}
                    </strong>
                </div>

                <div class="date-arrow">
                    →
                </div>

                <div>
                    <span>SELESAI</span>

                    <strong>
                        {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->translatedFormat('d M Y') }}
                    </strong>
                </div>

            </div>


            {{-- QUOTA --}}
            <div class="quota-section">

                <div class="quota-header">

                    <div>
                        <span>PEMAKAIAN KUOTA</span>

                        <strong>
                            {{ $terisi }} / {{ $periode->kuota }}
                        </strong>
                    </div>

                    <div class="quota-number">
                        {{ number_format($persentase, 0) }}%
                    </div>

                </div>


                <div class="quota-track">

                    <div
                        class="quota-fill {{ $isFull ? 'quota-fill-full' : '' }}"
                        style="width: {{ $persentase }}%"
                    ></div>

                </div>


                <div class="quota-footer">

                    @if($isFull)

                        <span class="quota-warning">
                            Kuota telah mencapai batas.
                        </span>

                    @else

                        <span>
                            Sisa kuota
                        </span>

                        <strong>
                            {{ $tersedia }} peserta
                        </strong>

                    @endif

                </div>

            </div>


            {{-- ACTION --}}
            <div class="period-actions">

                <a
                    href="{{ route('periode.edit', $periode) }}"
                    class="btn btn-outline"
                >
                    Edit Periode
                </a>

                <form
                    action="{{ route('periode.destroy', $periode) }}"
                    method="POST"
                    onsubmit="return confirm('Hapus periode {{ $periode->nama_periode }}? Data peserta yang terhubung dengan periode ini juga akan terhapus.');"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger-outline"
                    >
                        Hapus
                    </button>
                </form>

            </div>

        </article>

    @endforeach

</div>

@else

<div class="empty-state">

    <div class="empty-mark">
        PR
    </div>

    <span class="empty-kicker">
        DATA PERIODE
    </span>

    <h3>
        Belum ada periode PKL
    </h3>

    <p>
        Buat periode pertama untuk mulai mengatur unit kerja,
        waktu pelaksanaan, dan kuota peserta.
    </p>

    <a
        href="{{ route('periode.create') }}"
        class="btn btn-primary"
    >
        + Tambah Periode
    </a>

</div>

@endif


<style>

    /* ================================
       PERIOD SUMMARY
       ================================ */

    .period-summary {
        display: flex;
        align-items: stretch;
        margin: 18px 0 28px;
        min-height: 112px;
        border: 1px solid var(--putr-border);
        background: #fff;
    }

    .period-summary-main {
        flex: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .summary-label {
        display: block;
        margin-bottom: 5px;
        color: var(--putr-muted);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .13em;
    }

    .period-summary-main strong {
        color: var(--putr-navy);
        font-size: 34px;
        line-height: 1;
        letter-spacing: -.04em;
    }

    .period-summary-main small {
        margin-top: 6px;
        color: var(--putr-muted);
        font-size: 11px;
    }

    .period-summary-side {
        width: 120px;
        padding: 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #F5F7FA;
        border-left: 1px solid var(--putr-border);
    }

    .period-summary-side span {
        color: var(--putr-muted);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .12em;
    }

    .period-summary-side strong {
        margin-top: 4px;
        color: #247A45;
        font-size: 16px;
    }

    .period-summary-side small {
        margin-top: 2px;
        color: var(--putr-muted);
        font-size: 9px;
    }


    /* ================================
       LIST
       ================================ */

    .period-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .period-card {
        overflow: hidden;
        border: 1px solid var(--putr-border);
        background: #fff;
    }


    /* ================================
       HEADER
       ================================ */

    .period-card-header {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 15px;
        border-bottom: 1px solid var(--putr-border);
    }

    .period-index {
        flex: 0 0 34px;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--putr-navy);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
    }

    .period-title {
        min-width: 0;
        flex: 1;
    }

    .period-title span,
    .period-unit span,
    .period-date span,
    .quota-header span {
        display: block;
        margin-bottom: 4px;
        color: var(--putr-muted);
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .11em;
    }

    .period-title h3 {
        margin: 0;
        overflow: hidden;
        color: var(--putr-navy);
        font-size: 14px;
        line-height: 1.35;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    /* ================================
       STATUS
       ================================ */

    .quota-status {
        flex-shrink: 0;
        padding: 5px 7px;
        border: 1px solid;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .08em;
    }

    .quota-available {
        border-color: #CBE8D4;
        background: #EDF7F0;
        color: #247A45;
    }

    .quota-full {
        border-color: #E8CFCF;
        background: #FFF4F4;
        color: #A63D3D;
    }


    /* ================================
       UNIT
       ================================ */

    .period-unit {
        padding: 13px 15px;
        border-bottom: 1px solid #EEF1F4;
    }

    .period-unit strong {
        display: block;
        color: var(--putr-text);
        font-size: 12px;
        line-height: 1.4;
    }


    /* ================================
       DATE
       ================================ */

    .period-date {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 12px;
        padding: 13px 15px;
        background: #FAFBFC;
        border-bottom: 1px solid var(--putr-border);
    }

    .period-date strong {
        color: var(--putr-navy);
        font-size: 11px;
    }

    .date-arrow {
        color: var(--putr-muted);
        font-size: 15px;
    }


    /* ================================
       QUOTA
       ================================ */

    .quota-section {
        padding: 15px;
        border-bottom: 1px solid var(--putr-border);
    }

    .quota-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 10px;
    }

    .quota-header strong {
        color: var(--putr-navy);
        font-size: 15px;
    }

    .quota-number {
        color: var(--putr-blue);
        font-size: 13px;
        font-weight: 800;
    }

    .quota-track {
        height: 7px;
        margin-top: 10px;
        overflow: hidden;
        background: #E9EDF1;
    }

    .quota-fill {
        height: 100%;
        min-width: 2px;
        background: var(--putr-blue);
        transition: width .25s ease;
    }

    .quota-fill-full {
        background: var(--putr-yellow);
    }

    .quota-footer {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 7px;
        color: var(--putr-muted);
        font-size: 10px;
    }

    .quota-footer strong {
        color: var(--putr-navy);
    }

    .quota-warning {
        color: #A63D3D;
        font-weight: 700;
    }


    /* ================================
       ACTION
       ================================ */

    .period-actions {
        display: flex;
        gap: 8px;
        padding: 12px 15px;
    }

    .period-actions .btn {
        flex: 1;
        min-height: 35px;
        padding: 7px 10px;
        font-size: 10px;
    }

    .period-actions form {
        flex: 1;
        margin: 0;
    }

    .period-actions form .btn {
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


    /* ================================
       EMPTY
       ================================ */

    .empty-state {
        margin-top: 16px;
        padding: 42px 22px;
        border: 1px solid var(--putr-border);
        background: #fff;
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
        margin-bottom: 7px;
        color: var(--putr-muted);
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .13em;
    }

    .empty-state h3 {
        margin: 0;
        color: var(--putr-navy);
        font-size: 16px;
    }

    .empty-state p {
        max-width: 320px;
        margin: 8px auto 18px;
        color: var(--putr-muted);
        font-size: 11px;
        line-height: 1.6;
    }


    /* ================================
       MOBILE
       ================================ */

    @media (max-width: 360px) {

        .period-card-header {
            flex-wrap: wrap;
        }

        .quota-status {
            margin-left: 45px;
        }

        .period-actions {
            flex-wrap: wrap;
        }

        .period-actions .btn,
        .period-actions form {
            flex: 1 1 calc(50% - 4px);
        }

    }

</style>

@endsection