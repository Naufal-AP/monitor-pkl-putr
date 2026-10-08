@extends('layouts.app')

@section('title', 'Peserta PKL')

@section('content')

<div class="page-header">

    <div>
        <p>Pengelolaan</p>
        <h1>Peserta PKL</h1>
    </div>

    <a href="{{ route('peserta.create') }}" class="add-btn">
        +
    </a>

</div>
<form action="{{ route('peserta.index') }}" method="GET" class="search-form">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Cari nama, institusi, atau jurusan..."
    >

    <button type="submit">
        🔍
    </button>

</form>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@if($pesertas->count())

    <div class="peserta-list">

        @foreach($pesertas as $peserta)

            <div class="peserta-card">

                <div class="top">

                    <div class="avatar">
                        {{ strtoupper(substr($peserta->nama, 0, 1)) }}
                    </div>

                    <div class="identity">

                        <h2>
    <a href="{{ route('peserta.show', $peserta) }}" class="participant-name">
        {{ $peserta->nama }}
    </a>
</h2>

                        <p>{{ $peserta->institusi }}</p>

                    </div>

                    @if($peserta->status === 'aktif')

                        <span class="status aktif">
                            AKTIF
                        </span>

                    @else

                        <span class="status selesai">
                            SELESAI
                        </span>

                    @endif

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

                </div>

                @if($peserta->status === 'aktif')

<div class="action-buttons">

    <a href="{{ route('peserta.edit', $peserta) }}" class="btn-secondary">
        Edit
    </a>

    <form
        action="{{ route('peserta.selesai', $peserta) }}"
        method="POST"
        onsubmit="return confirm('Tandai peserta ini sebagai selesai?')">

        @csrf
        @method('PATCH')

        <button type="submit" class="finish-btn">
            ✓ Tandai PKL Selesai
        </button>

    </form>

</div>

                @endif

            </div>

        @endforeach

    </div>

@else

    <div class="empty">

        <div>👥</div>

        <h2>Belum ada peserta</h2>

        <p>
            Tambahkan peserta PKL untuk mulai mengelola data.
        </p>

        <a href="{{ route('peserta.create') }}">
            + Tambah Peserta
        </a>

    </div>

@endif


<style>

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.page-header p {
    color: #6b7280;
    font-size: 12px;
}

.page-header h1 {
    font-size: 24px;
    margin-top: 4px;
}

.add-btn {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #2563eb;
    color: white;

    border-radius: 12px;

    font-size: 25px;
    text-decoration: none;
}

.success {
    padding: 12px;

    background: #dcfce7;
    color: #166534;

    border-radius: 10px;

    font-size: 13px;

    margin-bottom: 15px;
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

    background: #eff6ff;
    color: #2563eb;

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

.aktif {
    background: #dcfce7;
    color: #15803d;
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

.finish-btn {
    width: 100%;

    margin-top: 16px;

    padding: 10px;

    border: none;

    background: #eff6ff;
    color: #2563eb;

    border-radius: 9px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;
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
    margin: 8px 0 20px;
}

.empty a {
    display: inline-block;

    padding: 12px 18px;

    background: #2563eb;
    color: white;

    border-radius: 10px;

    text-decoration: none;

    font-size: 13px;
}

.participant-name {
    color: #1e293b;
    text-decoration: none;
}

.participant-name:hover {
    text-decoration: underline;
}

</style>

@endsection