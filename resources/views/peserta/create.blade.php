@extends('layouts.app')

@section('title', 'Tambah Peserta')

@section('content')

<div class="form-page">

    {{-- HEADER --}}
    <header class="form-header">

        <a href="{{ route('peserta.index') }}" class="back-link">
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
                Tambah Peserta
            </h1>

            <p>
                Masukkan data peserta yang akan melaksanakan PKL.
            </p>

        </div>

    </header>


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="form-alert error">

            <div class="alert-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4"/>
                    <path d="M12 16h.01"/>
                </svg>
            </div>

            <div>
                <strong>
                    Data tidak dapat disimpan
                </strong>

                <span>
                    {{ session('error') }}
                </span>
            </div>

        </div>

    @endif


    {{-- VALIDATION --}}
    @if($errors->any())

        <div class="form-alert validation">

            <div class="alert-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4"/>
                    <path d="M12 16h.01"/>
                </svg>
            </div>

            <div>

                <strong>
                    Periksa kembali data
                </strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('peserta.store') }}"
        method="POST"
        class="participant-form"
    >

        @csrf


        {{-- =================================================
             SECTION 01
        ================================================== --}}

        <section class="form-section">

            <div class="form-section-header">

                <div class="section-number">
                    01
                </div>

                <div>

                    <span>
                        IDENTITAS
                    </span>

                    <h2>
                        Data Peserta
                    </h2>

                </div>

            </div>


            <div class="form-fields">

                {{-- NAMA --}}
                <div class="field">

                    <label for="nama">
                        Nama Lengkap
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                    >

                    @error('nama')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- INSTITUSI --}}
                <div class="field">

                    <label for="institusi">
                        Institusi / Perguruan Tinggi
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="institusi"
                        name="institusi"
                        value="{{ old('institusi') }}"
                        placeholder="Contoh: Universitas Kuningan"
                        required
                    >

                    @error('institusi')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- JURUSAN --}}
                <div class="field">

                    <label for="jurusan">
                        Program Studi / Jurusan
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="jurusan"
                        name="jurusan"
                        value="{{ old('jurusan') }}"
                        placeholder="Contoh: Sistem Informasi"
                        required
                    >

                    @error('jurusan')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>

        </section>


        {{-- =================================================
             SECTION 02
        ================================================== --}}

        <section class="form-section">

            <div class="form-section-header">

                <div class="section-number">
                    02
                </div>

                <div>

                    <span>
                        PENEMPATAN
                    </span>

                    <h2>
                        Penanggung Jawab
                    </h2>

                </div>

            </div>


            <div class="form-fields">

                {{-- PEMBIMBING --}}
                <div class="field">

                    <label for="pembimbing">
                        Pembimbing
                        <span>*</span>
                    </label>

                    <input
                        type="text"
                        id="pembimbing"
                        name="pembimbing"
                        value="{{ old('pembimbing') }}"
                        placeholder="Nama pembimbing dari instansi"
                        required
                    >

                    @error('pembimbing')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- PERIODE --}}
                <div class="field">

                    <label for="periode_id">
                        Periode PKL
                        <span>*</span>
                    </label>

                    <div class="select-wrapper">

                        <select
                            id="periode_id"
                            name="periode_id"
                            required
                        >

                            <option value="">
                                Pilih periode PKL
                            </option>

                            @foreach($periodes as $periode)

                                @php

                                    $terisi = $periode->peserta()
                                        ->where('status', 'aktif')
                                        ->count();

                                    $tersedia = $periode->kuota - $terisi;

                                @endphp

                                <option
                                    value="{{ $periode->id }}"
                                    {{ old('periode_id') == $periode->id ? 'selected' : '' }}
                                    {{ $tersedia <= 0 ? 'disabled' : '' }}
                                >
                                    {{ $periode->nama_periode }}
                                    — {{ $periode->unit_kerja }}
                                    {{ $tersedia <= 0 ? ' (PENUH)' : ' (' . $tersedia . ' kuota tersedia)' }}
                                </option>

                            @endforeach

                        </select>

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="m6 9 6 6 6-6"/>
                        </svg>

                    </div>

                    @error('periode_id')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>

        </section>


        {{-- =================================================
             SECTION 03
        ================================================== --}}

        <section class="form-section">

            <div class="form-section-header">

                <div class="section-number">
                    03
                </div>

                <div>

                    <span>
                        WAKTU PELAKSANAAN
                    </span>

                    <h2>
                        Periode Pelaksanaan
                    </h2>

                </div>

            </div>


            <div class="date-grid">

                {{-- MULAI --}}
                <div class="field">

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

                    @error('tanggal_mulai')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- SELESAI --}}
                <div class="field">

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

                    @error('tanggal_selesai')
                        <small class="field-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

            </div>


            <div class="date-note">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.7"
                >
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4l2.5 1.5"/>
                </svg>

                <span>
                    Pastikan tanggal pelaksanaan sesuai dengan surat atau dokumen permohonan PKL.
                </span>

            </div>

        </section>


        {{-- =================================================
             ACTION
        ================================================== --}}

        <div class="form-actions">

            <a
                href="{{ route('peserta.index') }}"
                class="cancel-button"
            >
                Batal
            </a>

            <button
                type="submit"
                class="save-button"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                    <path d="M17 21v-8H7v8"/>
                    <path d="M7 3v5h8"/>
                </svg>

                Simpan Data

            </button>

        </div>


        <div class="required-note">
            <span>*</span>
            Kolom wajib diisi
        </div>

    </form>

</div>


@push('styles')

<style>

    /* =====================================================
       PAGE
    ====================================================== */

    .form-page {
        padding-bottom: 10px;
    }


    /* =====================================================
       HEADER
    ====================================================== */

    .form-header {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        padding-bottom: 17px;

        margin-bottom: 17px;

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


    .form-header h1 {
        margin-top: 3px;

        color: var(--putr-navy);

        font-size: 21px;
        line-height: 1.15;

        font-weight: 750;

        letter-spacing: -.02em;
    }


    .form-header p {
        margin-top: 4px;

        color: var(--text-muted);

        font-size: 8px;
    }


    /* =====================================================
       ALERT
    ====================================================== */

    .form-alert {
        display: flex;
        align-items: flex-start;

        gap: 9px;

        padding: 10px 11px;

        margin-bottom: 12px;

        border-radius: 7px;

        font-size: 8px;
    }


    .form-alert.error {
        background: var(--danger-bg);

        border: 1px solid #F1D0CD;

        color: var(--danger);
    }


    .form-alert.validation {
        background: var(--warning-bg);

        border: 1px solid #F0DFAD;

        color: var(--warning);
    }


    .alert-icon {
        width: 18px;
        height: 18px;

        flex: 0 0 18px;

        display: flex;
        align-items: center;
        justify-content: center;
    }


    .alert-icon svg {
        width: 15px;
        height: 15px;
    }


    .form-alert strong {
        display: block;

        margin-bottom: 2px;

        font-size: 9px;
        font-weight: 750;
    }


    .form-alert span {
        display: block;

        line-height: 1.45;
    }


    .form-alert ul {
        margin: 3px 0 0 13px;

        padding: 0;
    }


    .form-alert li {
        margin-bottom: 2px;
    }


    /* =====================================================
       FORM SECTION
    ====================================================== */

    .participant-form {
        display: grid;

        gap: 10px;
    }


    .form-section {
        padding: 15px;

        background: #fff;

        border: 1px solid var(--border);

        border-radius: 9px;

        box-shadow:
            0 3px 8px rgba(16, 42, 67, .025);
    }


    .form-section-header {
        display: flex;
        align-items: center;

        gap: 9px;

        padding-bottom: 12px;

        margin-bottom: 13px;

        border-bottom: 1px solid #EDF1F4;
    }


    .section-number {
        width: 27px;
        height: 27px;

        flex: 0 0 27px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--putr-navy);

        color: var(--putr-yellow);

        border-radius: 6px;

        font-size: 8px;
        font-weight: 800;
    }


    .form-section-header span {
        display: block;

        color: var(--putr-blue);

        font-size: 6px;
        font-weight: 800;

        letter-spacing: .08em;
    }


    .form-section-header h2 {
        margin-top: 2px;

        color: var(--text);

        font-size: 11px;
        font-weight: 720;
    }


    /* =====================================================
       FIELDS
    ====================================================== */

    .form-fields {
        display: grid;

        gap: 12px;
    }


    .field {
        min-width: 0;
    }


    .field label {
        display: block;

        margin-bottom: 5px;

        color: var(--text);

        font-size: 8px;
        font-weight: 700;
    }


    .field label span {
        color: var(--danger);

        margin-left: 2px;
    }


    .field input,
    .field select {
        width: 100%;

        height: 39px;

        padding: 0 10px;

        border: 1px solid var(--border);
        border-radius: 7px;

        background: #fff;

        color: var(--text);

        font-size: 9px;

        outline: none;

        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }


    .field input::placeholder {
        color: #A7B8C8;
    }


    .field input:focus,
    .field select:focus {
        border-color: var(--putr-blue);

        box-shadow:
            0 0 0 3px rgba(23, 105, 170, .07);
    }


    .select-wrapper {
        position: relative;
    }


    .select-wrapper select {
        appearance: none;

        padding-right: 32px;

        cursor: pointer;
    }


    .select-wrapper > svg {
        position: absolute;

        right: 10px;
        top: 50%;

        width: 13px;
        height: 13px;

        transform: translateY(-50%);

        color: var(--text-muted);

        pointer-events: none;
    }


    .field-error {
        display: block;

        margin-top: 4px;

        color: var(--danger);

        font-size: 7px;
        line-height: 1.35;
    }


    /* =====================================================
       DATE
    ====================================================== */

    .date-grid {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 8px;
    }


    .date-note {
        display: flex;
        align-items: flex-start;

        gap: 7px;

        margin-top: 12px;

        padding: 8px 9px;

        background: #F6F8FA;

        border: 1px solid #E7EDF2;

        border-radius: 6px;

        color: var(--text-muted);

        font-size: 7px;

        line-height: 1.45;
    }


    .date-note svg {
        width: 13px;
        height: 13px;

        flex: 0 0 13px;

        color: var(--putr-blue);
    }


    /* =====================================================
       ACTION
    ====================================================== */

    .form-actions {
        display: flex;

        gap: 7px;

        margin-top: 3px;
    }


    .cancel-button,
    .save-button {
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 7px;

        font-size: 9px;
        font-weight: 700;

        text-decoration: none;

        cursor: pointer;
    }


    .cancel-button {
        flex: 0 0 32%;

        border: 1px solid var(--border);

        background: #fff;

        color: var(--text-secondary);
    }


    .save-button {
        flex: 1;

        gap: 6px;

        border: 0;

        background: var(--putr-navy);

        color: #fff;
    }


    .save-button:hover {
        background: var(--putr-blue-dark);
    }


    .save-button svg {
        width: 14px;
        height: 14px;
    }


    .required-note {
        text-align: right;

        color: var(--text-muted);

        font-size: 7px;
    }


    .required-note span {
        color: var(--danger);
    }


    /* =====================================================
       SMALL DEVICE
    ====================================================== */

    @media (max-width: 360px) {

        .form-section {
            padding: 13px;
        }

        .date-grid {
            grid-template-columns: 1fr;
        }

        .cancel-button {
            flex-basis: 30%;
        }

    }

</style>

@endpush

@endsection