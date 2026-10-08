@extends('layouts.app')

@section('title', 'PKL Selesai')

@section('content')

<div class="page-header">

    <div>
        <p>Arsip</p>
        <h1>PKL Selesai</h1>
    </div>

</div>

<form action="{{ route('peserta.selesai.list') }}" method="GET" class="search-form">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari peserta..."
    >

    <button type="submit">
        🔍
    </button>

</form>

@if($pesertas->count())

    <div class="peserta-list">

        @foreach($pesertas as $peserta)

            <div class="peserta-card">

                <div class="top">

                    <div class="avatar">
                        {{ strtoupper(substr($peserta->nama, 0, 1)) }}
                    </div>

                    <div class="identity">

                        <h2>{{ $peserta->nama }}</h2>

                        <p>{{ $peserta->institusi }}</p>

                    </div>

                    <span class="status selesai">
                        SELESAI
                    </span>

                </div>

                <div class="info">

                    <div>
                        <span>Jurusan</span>
                        <strong>{{ $peserta->jurusan }}</strong>
                    </div>

                    <div>
                        <span>Pembimbing</span>
                        <strong>{{ $peserta->pembimbing }}</strong>
                    </div>

                    <div>
                        <span>Periode</span>
                        <strong>
                            {{ $peserta->periode->nama_periode }}
                        </strong>
                    </div>

                    <div>
                        <span>Masa PKL</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($peserta->tanggal_mulai)->format('d M Y') }}
                            -
                            {{ \Carbon\Carbon::parse($peserta->tanggal_selesai)->format('d M Y') }}
                        </strong>
                    </div>

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="empty">

        <div>📁</div>

        <h2>Belum ada arsip</h2>

        <p>
            Peserta yang sudah menyelesaikan PKL akan muncul di sini.
        </p>

    </div>

@endif


<style>

.page-header {
    margin-bottom: 20px;
}

.page-header p {
    color: #6b7280;
    font-size: 12px;
}

.page-header h1 {
    font-size: 24px;
    margin-top: 4px;
}

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

.search-form button {
    width: 44px;

    border: none;
    border-radius: 10px;

    background: #2563eb;
    color: white;

    cursor: pointer;
}

.peserta-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.peserta-card {
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 16px;
}

.top {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #f3f4f6;
    color: #6b7280;

    border-radius: 50%;
    font-weight: bold;
}

.identity {
    flex: 1;
}

.identity h2 {
    font-size: 14px;
}

.identity p {
    color: #6b7280;
    font-size: 11px;
    margin-top: 3px;
}

.status {
    padding: 5px 7px;
    border-radius: 6px;

    font-size: 9px;
    font-weight: bold;
}

.selesai {
    background: #e5e7eb;
    color: #4b5563;
}

.info {
    display: grid;
    gap: 10px;
    margin-top: 18px;
}

.info span {
    display: block;

    color: #6b7280;
    font-size: 10px;

    margin-bottom: 3px;
}

.info strong {
    font-size: 12px;
}

.empty {
    text-align: center;
    padding: 60px 20px;
}

.empty > div {
    font-size: 45px;
    margin-bottom: 15px;
}

.empty h2 {
    font-size: 18px;
}

.empty p {
    color: #6b7280;
    font-size: 13px;
    line-height: 1.5;
    margin-top: 8px;
}

</style>

@endsection