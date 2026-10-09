@extends('layouts.app')

@section('content')

<div class="page-header">

    <div>
        <div class="eyebrow">ADMINISTRASI PKL</div>

        <h1 class="page-title">
            Tambah Periode
        </h1>

        <p class="page-description">
            Buat periode baru untuk mengatur waktu pelaksanaan,
            unit kerja, dan kapasitas peserta PKL.
        </p>
    </div>

    <a
        href="{{ route('periode.index') }}"
        class="back-link"
    >
        ← Kembali
    </a>

</div>


{{-- VALIDATION ERROR --}}

@if($errors->any())

    <div class="alert alert-error">

        <div class="alert-title">
            Data belum dapat disimpan
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
    action="{{ route('periode.store') }}"
    method="POST"
    class="form-container"
>

    @csrf


    {{-- =========================
         01 IDENTITAS PERIODE
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
                    Tentukan nama dan unit kerja yang terkait dengan periode PKL.
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
                value="{{ old('nama_periode') }}"
                placeholder="Contoh: PKL Periode Januari 2027"
                required
            >

            <small>
                Gunakan nama yang mudah dikenali dalam administrasi.
            </small>

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
                value="{{ old('unit_kerja') }}"
                placeholder="Contoh: Sekretariat / Bidang Bina Marga"
                required
            >

            <small>
                Masukkan bagian atau unit kerja tempat peserta ditempatkan.
            </small>

        </div>

    </section>


    {{-- =========================
         02 WAKTU PELAKSANAAN
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
                    Tentukan rentang waktu pelaksanaan peserta PKL.
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
                    value="{{ old('tanggal_mulai') }}"
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
                    value="{{ old('tanggal_selesai') }}"
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
                    Tentukan jumlah maksimal peserta aktif yang dapat ditempatkan
                    pada periode ini.
                </p>
            </div>

        </div>


        <div class="quota-input-wrapper">

            <div class="quota-input">

                <input
                    type="number"
                    id="kuota"
                    name="kuota"
                    value="{{ old('kuota') }}"
                    min="1"
                    placeholder="0"
                    required
                >

                <span>
                    PESERTA
                </span>

            </div>

        </div>


        {{-- QUOTA PREVIEW --}}

        <div
            id="quota-preview"
            class="quota-preview"
        >

            <div>

                <span>
                    KAPASITAS PERIODE
                </span>

                <strong id="quota-value">
                    0
                </strong>

                <small>
                    peserta aktif maksimal
                </small>

            </div>

            <div class="quota-preview-mark">
                KUOTA
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
                Informasi
            </strong>

            <p>
                Kuota digunakan untuk membatasi jumlah peserta dengan status
                <strong>aktif</strong> pada periode ini. Peserta yang telah
                ditandai selesai tidak lagi dihitung dalam penggunaan kuota.
            </p>

        </div>

    </div>


    {{-- =========================
         ACTION
         ========================= --}}

    <div class="form-actions">

        <a
            href="{{ route('periode.index') }}"
            class="btn btn-outline"
        >
            Batal
        </a>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Simpan Periode
        </button>

    </div>

</form>


<style>

    /* ================================
       FORM CONTAINER
       ================================ */

    .form-container {
        margin-top: 20px;
    }


    /* ================================
       FORM SECTION
       ================================ */

    .form-section {
        margin-bottom: 14px;
        padding: 18px;
        border: 1px solid var(--putr-border);
        background: #ffffff;
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
        color: #ffffff;

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
       FORM GROUP
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

        outline: none;

        background: #ffffff;

        color: var(--putr-text);

        font-family: inherit;
        font-size: 12px;

        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }

    .form-group input:focus {
        border-color: var(--putr-blue);

        box-shadow:
            0 0 0 2px rgba(23, 105, 170, .08);
    }

    .form-group input::placeholder {
        color: #A0AAB5;
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

    .date-grid .form-group {
        min-width: 0;
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
       QUOTA
       ================================ */

    .quota-input-wrapper {
        margin-bottom: 12px;
    }

    .quota-input {
        display: flex;
        align-items: center;

        border: 1px solid #C9D2DC;
        background: #ffffff;
    }

    .quota-input:focus-within {
        border-color: var(--putr-blue);

        box-shadow:
            0 0 0 2px rgba(23, 105, 170, .08);
    }

    .quota-input input {
        width: 100%;
        min-height: 46px;

        padding: 10px 13px;

        border: 0;
        outline: 0;

        background: transparent;

        color: var(--putr-navy);

        font-family: inherit;
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
       QUOTA PREVIEW
       ================================ */

    .quota-preview {
        display: flex;
        align-items: center;
        justify-content: space-between;

        min-height: 82px;

        padding: 14px 16px;

        border: 1px solid #D9E1E8;

        background: #F6F8FA;
    }

    .quota-preview span {
        display: block;

        margin-bottom: 3px;

        color: var(--putr-muted);

        font-size: 8px;
        font-weight: 800;

        letter-spacing: .11em;
    }

    .quota-preview strong {
        display: block;

        color: var(--putr-navy);

        font-size: 25px;
        line-height: 1;
    }

    .quota-preview small {
        display: block;

        margin-top: 4px;

        color: var(--putr-muted);

        font-size: 9px;
    }

    .quota-preview-mark {
        padding: 8px 10px;

        border: 1px solid #CBD4DD;

        color: var(--putr-blue);

        font-size: 9px;
        font-weight: 800;

        letter-spacing: .08em;
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

    @media (max-width: 360px) {

        .form-section {
            padding: 15px;
        }

        .date-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .date-grid .form-group {
            margin-bottom: 16px;
        }

        .quota-preview {
            padding: 13px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

    }

</style>


@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const mulai = document.getElementById('tanggal_mulai');
        const selesai = document.getElementById('tanggal_selesai');

        const warning = document.getElementById('date-warning');

        const kuota = document.getElementById('kuota');
        const quotaValue = document.getElementById('quota-value');


        /*
        |--------------------------------------------------------------------------
        | DATE VALIDATION
        |--------------------------------------------------------------------------
        */

        function validateDates() {

            if (!mulai.value || !selesai.value) {
                warning.style.display = 'none';
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


        selesai.addEventListener('change', validateDates);


        /*
        |--------------------------------------------------------------------------
        | QUOTA PREVIEW
        |--------------------------------------------------------------------------
        */

        function updateQuotaPreview() {

            const value = parseInt(kuota.value);

            if (isNaN(value) || value < 0) {

                quotaValue.textContent = '0';

                return;
            }

            quotaValue.textContent = value;

        }


        kuota.addEventListener('input', updateQuotaPreview);


        updateQuotaPreview();

    });

</script>

@endpush

@endsection