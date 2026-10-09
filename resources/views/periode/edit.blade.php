@extends('layouts.app')

@section('content')

@php
    $terisi = $periode->peserta()
        ->where('status', 'aktif')
        ->count();

    $sisaKuota = max($periode->kuota - $terisi, 0);
@endphp

<div class="page-header">

    <div>
        <div class="eyebrow">PEMUTAKHIRAN ADMINISTRASI</div>

        <h1 class="page-title">
            Edit Periode
        </h1>

        <p class="page-description">
            Perbarui informasi periode, jadwal pelaksanaan, unit kerja,
            atau kapasitas peserta PKL.
        </p>
    </div>

    <a
        href="{{ route('periode.index') }}"
        class="back-link"
    >
        ← Kembali
    </a>

</div>


{{-- CURRENT RECORD --}}

<div class="record-strip">

    <div>
        <span>RECORD ID</span>

        <strong>
            #{{ str_pad($periode->id, 4, '0', STR_PAD_LEFT) }}
        </strong>
    </div>

    <div>
        <span>PERIODE SAAT INI</span>

        <strong>
            {{ $periode->nama_periode }}
        </strong>
    </div>

    <div>
        <span>PESERTA AKTIF</span>

        <strong>
            {{ $terisi }} / {{ $periode->kuota }}
        </strong>
    </div>

</div>


{{-- ERROR --}}

@if($errors->any())

    <div class="alert alert-error">

        <div class="alert-title">
            Perubahan belum dapat disimpan
        </div>

        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif


{{-- FORM --}}

<form
    action="{{ route('periode.update', $periode) }}"
    method="POST"
    class="form-container"
>

    @csrf
    @method('PUT')


    {{-- =========================
         01 IDENTITAS
         ========================= --}}

    <section class="form-section">

        <div class="form-section-header">

            <div class="form-number">
                01
            </div>

            <div>

                <span class="form-kicker">
                    IDENTITAS PERIODE
                </span>

                <h2>
                    Informasi Dasar
                </h2>

                <p>
                    Perbarui nama periode dan unit kerja terkait.
                </p>

            </div>

        </div>


        <div class="form-group">

            <label for="nama_periode">
                Nama Periode
                <span>*</span>
            </label>

            <input
                type="text"
                id="nama_periode"
                name="nama_periode"
                value="{{ old('nama_periode', $periode->nama_periode) }}"
                required
            >

        </div>


        <div class="form-group">

            <label for="unit_kerja">
                Unit Kerja
                <span>*</span>
            </label>

            <input
                type="text"
                id="unit_kerja"
                name="unit_kerja"
                value="{{ old('unit_kerja', $periode->unit_kerja) }}"
                required
            >

        </div>

    </section>


    {{-- =========================
         02 JADWAL
         ========================= --}}

    <section class="form-section">

        <div class="form-section-header">

            <div class="form-number">
                02
            </div>

            <div>

                <span class="form-kicker">
                    WAKTU PELAKSANAAN
                </span>

                <h2>
                    Jadwal Periode
                </h2>

                <p>
                    Perbarui rentang waktu pelaksanaan periode PKL.
                </p>

            </div>

        </div>


        <div class="date-grid">

            <div class="form-group">

                <label for="tanggal_mulai">
                    Tanggal Mulai
                    <span>*</span>
                </label>

                <input
                    type="date"
                    id="tanggal_mulai"
                    name="tanggal_mulai"
                    value="{{ old('tanggal_mulai', $periode->tanggal_mulai) }}"
                    required
                >

            </div>


            <div class="form-group">

                <label for="tanggal_selesai">
                    Tanggal Selesai
                    <span>*</span>
                </label>

                <input
                    type="date"
                    id="tanggal_selesai"
                    name="tanggal_selesai"
                    value="{{ old('tanggal_selesai', $periode->tanggal_selesai) }}"
                    required
                >

            </div>

        </div>


        <div
            id="date-warning"
            class="inline-warning"
            style="display: none;"
        >
            Tanggal selesai tidak boleh lebih awal dari tanggal mulai.
        </div>

    </section>


    {{-- =========================
         03 KUOTA
         ========================= --}}

    <section class="form-section">

        <div class="form-section-header">

            <div class="form-number">
                03
            </div>

            <div>

                <span class="form-kicker">
                    KAPASITAS PESERTA
                </span>

                <h2>
                    Pengaturan Kuota
                </h2>

                <p>
                    Sesuaikan kapasitas peserta aktif untuk periode ini.
                </p>

            </div>

        </div>


        {{-- CURRENT QUOTA --}}

        <div class="quota-current">

            <div>

                <span>
                    KUOTA SAAT INI
                </span>

                <strong>
                    {{ $periode->kuota }}
                </strong>

            </div>

            <div class="quota-current-divider"></div>

            <div>

                <span>
                    SUDAH TERISI
                </span>

                <strong>
                    {{ $terisi }}
                </strong>

            </div>

            <div class="quota-current-divider"></div>

            <div>

                <span>
                    TERSEDIA
                </span>

                <strong>
                    {{ $sisaKuota }}
                </strong>

            </div>

        </div>


        <div class="form-group quota-field">

            <label for="kuota">
                Kuota Baru
                <span>*</span>
            </label>

            <div class="quota-input">

                <input
                    type="number"
                    id="kuota"
                    name="kuota"
                    value="{{ old('kuota', $periode->kuota) }}"
                    min="{{ max($terisi, 1) }}"
                    required
                >

                <span>
                    PESERTA
                </span>

            </div>

            <small>
                Kuota minimal harus {{ $terisi }} peserta karena saat ini
                terdapat {{ $terisi }} peserta aktif pada periode ini.
            </small>

        </div>


        {{-- QUOTA STATUS --}}

        <div
            id="quota-status"
            class="quota-status-box"
        >

            <div class="quota-status-mark">
                ✓
            </div>

            <div>

                <strong id="quota-status-title">
                    Kuota aman untuk disimpan
                </strong>

                <p id="quota-status-text">
                    Nilai kuota saat ini dapat digunakan.
                </p>

            </div>

        </div>

    </section>


    {{-- =========================
         INFORMATION
         ========================= --}}

    <div class="form-note">

        <div class="form-note-mark">
            i
        </div>

        <div>

            <strong>
                Perhatian sebelum menyimpan
            </strong>

            <p>
                Terdapat <strong>{{ $terisi }} peserta aktif</strong>
                pada periode ini. Kuota tidak dapat dikurangi di bawah
                jumlah peserta aktif yang sudah terdaftar.
            </p>

        </div>

    </div>


    {{-- ACTION --}}

    <div class="form-actions">

        <a
            href="{{ route('periode.index') }}"
            class="btn btn-outline"
        >
            Batal
        </a>

        <button
            type="submit"
            id="submit-button"
            class="btn btn-primary"
        >
            Simpan Perubahan
        </button>

    </div>

</form>


<style>

    /* ================================
       RECORD STRIP
       ================================ */

    .record-strip {
        display: grid;
        grid-template-columns: .8fr 1.5fr 1fr;

        margin-top: 18px;

        border: 1px solid var(--putr-border);
        background: #fff;
    }

    .record-strip > div {
        min-width: 0;
        padding: 13px 14px;

        border-right: 1px solid var(--putr-border);
    }

    .record-strip > div:last-child {
        border-right: 0;
    }

    .record-strip span {
        display: block;

        margin-bottom: 4px;

        color: var(--putr-muted);

        font-size: 8px;
        font-weight: 800;

        letter-spacing: .11em;
    }

    .record-strip strong {
        display: block;

        overflow: hidden;

        color: var(--putr-navy);

        font-size: 11px;
        line-height: 1.4;

        text-overflow: ellipsis;
        white-space: nowrap;
    }


    /* ================================
       FORM
       ================================ */

    .form-container {
        margin-top: 18px;
    }

    .form-section {
        margin-bottom: 14px;

        padding: 18px;

        border: 1px solid var(--putr-border);
        background: #fff;
    }

    .form-section-header {
        display: flex;
        align-items: flex-start;

        gap: 12px;

        margin-bottom: 20px;
    }

    .form-number {
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

    .form-section-header > div:last-child {
        flex: 1;
        min-width: 0;
    }

    .form-kicker {
        display: block;

        margin-bottom: 3px;

        color: var(--putr-muted);

        font-size: 8px;
        font-weight: 800;

        letter-spacing: .13em;
    }

    .form-section h2 {
        margin: 0;

        color: var(--putr-navy);

        font-size: 17px;
        line-height: 1.3;
    }

    .form-section-header p {
        margin: 5px 0 0;

        color: var(--putr-muted);

        font-size: 10px;
        line-height: 1.55;
    }


    /* ================================
       INPUT
       ================================ */

    .form-group {
        margin-bottom: 16px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;

        margin-bottom: 7px;

        color: var(--putr-navy);

        font-size: 11px;
        font-weight: 700;
    }

    .form-group label span {
        color: #B34040;
    }

    .form-group input {
        width: 100%;
        box-sizing: border-box;

        min-height: 43px;

        padding: 10px 12px;

        border: 1px solid #C9D2DC;

        border-radius: 0;

        outline: 0;

        background: #fff;

        color: var(--putr-text);

        font-family: inherit;
        font-size: 12px;
    }

    .form-group input:focus {
        border-color: var(--putr-blue);

        box-shadow:
            0 0 0 2px rgba(23, 105, 170, .08);
    }

    .form-group small {
        display: block;

        margin-top: 5px;

        color: var(--putr-muted);

        font-size: 9px;
        line-height: 1.5;
    }


    /* ================================
       DATE
       ================================ */

    .date-grid {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 10px;
    }

    input[type="date"] {
        color-scheme: light;
    }


    /* ================================
       WARNING
       ================================ */

    .inline-warning {
        margin-top: 10px;

        padding: 10px 11px;

        border: 1px solid #E8CFCF;

        background: #FFF5F5;

        color: #A63D3D;

        font-size: 10px;
        font-weight: 600;

        line-height: 1.5;
    }


    /* ================================
       CURRENT QUOTA
       ================================ */

    .quota-current {
        display: grid;

        grid-template-columns: 1fr auto 1fr auto 1fr;

        align-items: center;

        margin-bottom: 17px;

        border: 1px solid #D9E1E8;

        background: #F6F8FA;
    }

    .quota-current > div:not(.quota-current-divider) {
        padding: 13px 10px;

        text-align: center;
    }

    .quota-current span {
        display: block;

        margin-bottom: 4px;

        color: var(--putr-muted);

        font-size: 7px;
        font-weight: 800;

        letter-spacing: .09em;
    }

    .quota-current strong {
        color: var(--putr-navy);

        font-size: 19px;

        line-height: 1;
    }

    .quota-current-divider {
        width: 1px;
        height: 30px;

        background: #D9E1E8;
    }


    /* ================================
       QUOTA INPUT
       ================================ */

    .quota-input {
        display: flex;
        align-items: center;

        border: 1px solid #C9D2DC;

        background: #fff;
    }

    .quota-input:focus-within {
        border-color: var(--putr-blue);

        box-shadow:
            0 0 0 2px rgba(23, 105, 170, .08);
    }

    .quota-input input {
        border: 0 !important;

        box-shadow: none !important;

        min-height: 46px;

        font-size: 18px;

        font-weight: 800;
    }

    .quota-input span {
        padding: 0 13px;

        color: var(--putr-muted);

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .1em;

        white-space: nowrap;
    }


    /* ================================
       QUOTA STATUS
       ================================ */

    .quota-status-box {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        margin-top: 14px;

        padding: 12px;

        border: 1px solid #CBE8D4;

        background: #F2FAF4;
    }

    .quota-status-mark {
        flex: 0 0 24px;

        width: 24px;
        height: 24px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #247A45;
        color: #fff;

        font-size: 11px;
        font-weight: 800;
    }

    .quota-status-box strong {
        display: block;

        color: #247A45;

        font-size: 10px;
    }

    .quota-status-box p {
        margin: 3px 0 0;

        color: #5C7564;

        font-size: 9px;

        line-height: 1.5;
    }


    /* ================================
       NOTE
       ================================ */

    .form-note {
        display: flex;
        align-items: flex-start;

        gap: 11px;

        margin: 18px 0;

        padding: 13px;

        border-left: 3px solid var(--putr-yellow);

        background: #F8F9FA;
    }

    .form-note-mark {
        flex: 0 0 22px;

        width: 22px;
        height: 22px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #CCD5DE;

        color: var(--putr-navy);

        font-size: 11px;
        font-weight: 900;
    }

    .form-note strong {
        color: var(--putr-navy);

        font-size: 10px;
    }

    .form-note p {
        margin: 3px 0 0;

        color: var(--putr-muted);

        font-size: 9px;

        line-height: 1.6;
    }


    /* ================================
       ACTION
       ================================ */

    .form-actions {
        display: flex;

        gap: 8px;

        margin-top: 20px;

        padding-bottom: 10px;
    }

    .form-actions .btn {
        flex: 1;

        min-height: 42px;

        font-size: 11px;
    }


    /* ================================
       ERROR
       ================================ */

    .alert-error {
        margin-top: 18px;

        padding: 13px 14px;

        border: 1px solid #E8CFCF;

        background: #FFF5F5;

        color: #A63D3D;
    }

    .alert-title {
        margin-bottom: 5px;

        font-size: 11px;
        font-weight: 800;
    }

    .alert-error ul {
        margin: 0;

        padding-left: 17px;

        font-size: 10px;

        line-height: 1.6;
    }


    /* ================================
       MOBILE
       ================================ */

    @media (max-width: 390px) {

        .record-strip {
            grid-template-columns: 1fr 1fr;
        }

        .record-strip > div {
            border-bottom: 1px solid var(--putr-border);
        }

        .record-strip > div:nth-child(2) {
            border-right: 0;
        }

        .record-strip > div:last-child {
            grid-column: 1 / -1;

            border-bottom: 0;
            border-right: 0;
        }

    }

    @media (max-width: 360px) {

        .form-section {
            padding: 15px;
        }

        .date-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .quota-current {
            grid-template-columns: 1fr 1fr 1fr;
        }

        .quota-current-divider {
            display: none;
        }

        .quota-current > div:not(.quota-current-divider) {
            padding: 12px 5px;
        }

        .quota-current strong {
            font-size: 17px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

    }

</style>


@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const mulai =
            document.getElementById('tanggal_mulai');

        const selesai =
            document.getElementById('tanggal_selesai');

        const warning =
            document.getElementById('date-warning');

        const kuota =
            document.getElementById('kuota');

        const quotaStatus =
            document.getElementById('quota-status');

        const quotaTitle =
            document.getElementById('quota-status-title');

        const quotaText =
            document.getElementById('quota-status-text');

        const submitButton =
            document.getElementById('submit-button');

        const pesertaAktif =
            {{ $terisi }};


        /*
        |--------------------------------------------------------------------------
        | DATE VALIDATION
        |--------------------------------------------------------------------------
        */

        function validateDates() {

            if (!mulai.value || !selesai.value) {

                warning.style.display = 'none';

                selesai.setCustomValidity('');

                return;

            }


            if (selesai.value < mulai.value) {

                warning.style.display = 'block';

                selesai.setCustomValidity(
                    'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.'
                );

            } else {

                warning.style.display = 'none';

                selesai.setCustomValidity('');

            }

        }


        mulai.addEventListener('change', function () {

            selesai.min = mulai.value;

            validateDates();

        });


        selesai.addEventListener(
            'change',
            validateDates
        );


        selesai.min = mulai.value;


        /*
        |--------------------------------------------------------------------------
        | QUOTA VALIDATION
        |--------------------------------------------------------------------------
        */

        function validateQuota() {

            const value =
                parseInt(kuota.value);


            if (
                isNaN(value) ||
                value < pesertaAktif
            ) {

                quotaStatus.style.borderColor =
                    '#E8CFCF';

                quotaStatus.style.background =
                    '#FFF5F5';

                quotaTitle.style.color =
                    '#A63D3D';

                quotaText.style.color =
                    '#8C5A5A';

                quotaStatus.querySelector(
                    '.quota-status-mark'
                ).style.background =
                    '#A63D3D';

                quotaStatus.querySelector(
                    '.quota-status-mark'
                ).textContent =
                    '!';


                quotaTitle.textContent =
                    'Kuota terlalu kecil';

                quotaText.textContent =
                    'Kuota minimal harus ' +
                    pesertaAktif +
                    ' karena terdapat ' +
                    pesertaAktif +
                    ' peserta aktif.';

                submitButton.disabled = true;

                submitButton.style.opacity =
                    '0.55';

                submitButton.style.cursor =
                    'not-allowed';

                return;

            }


            const tersedia =
                value - pesertaAktif;


            quotaStatus.style.borderColor =
                '#CBE8D4';

            quotaStatus.style.background =
                '#F2FAF4';

            quotaTitle.style.color =
                '#247A45';

            quotaText.style.color =
                '#5C7564';

            quotaStatus.querySelector(
                '.quota-status-mark'
            ).style.background =
                '#247A45';

            quotaStatus.querySelector(
                '.quota-status-mark'
            ).textContent =
                '✓';


            quotaTitle.textContent =
                'Kuota aman untuk disimpan';

            quotaText.textContent =
                'Setelah perubahan, tersedia ' +
                tersedia +
                ' slot peserta aktif.';

            submitButton.disabled = false;

            submitButton.style.opacity =
                '1';

            submitButton.style.cursor =
                'pointer';

        }


        kuota.addEventListener(
            'input',
            validateQuota
        );


        validateQuota();

    });

</script>

@endpush

@endsection