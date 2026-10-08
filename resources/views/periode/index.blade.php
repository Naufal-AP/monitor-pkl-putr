@extends('layouts.app')

@section('title', 'Kuota Periode')

@section('content')

<div class="page-header">
    <div>
        <p class="subtitle">Pengelolaan</p>
        <h1>Kuota Periode</h1>
    </div>

    <a href="{{ route('periode.create') }}" class="add-btn">
        +
    </a>
</div>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@if($periodes->count() > 0)

    <div class="period-list">

        @foreach($periodes as $periode)

            @php
                $terisi = $periode->peserta()
    ->where('status', 'aktif')
    ->count();
                $persentase = $periode->kuota > 0
                    ? min(($terisi / $periode->kuota) * 100, 100)
                    : 0;

                $penuh = $terisi >= $periode->kuota;
            @endphp

            <div class="period-card">

                <div class="card-header">

                    <div>
                        <h2>{{ $periode->nama_periode }}</h2>

                        <p>
                            {{ $periode->unit_kerja }}
                        </p>
                    </div>

                    @if($penuh)

                        <span class="badge full">
                            PENUH
                        </span>

                    @else

                        <span class="badge available">
                            TERSEDIA
                        </span>

                    @endif

                </div>

                <div class="date">
                    {{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d M Y') }}
                </div>

                <div class="quota-info">

                    <div>
                        <span>Kuota terisi</span>

                        <strong>
                            {{ $terisi }} / {{ $periode->kuota }}
                        </strong>
                    </div>

                    <span>
                        {{ round($persentase) }}%
                    </span>

                </div>

                <div class="progress">
                    <div
                        class="progress-bar"
                        style="width: {{ $persentase }}%">
                    </div>
                </div>

                <div class="actions">

                    <a
                        href="{{ route('periode.edit', $periode) }}"
                        class="edit">
                        Edit
                    </a>

                    <form
                        action="{{ route('periode.destroy', $periode) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus periode ini?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete">
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="empty">

        <div class="empty-icon">
            📋
        </div>

        <h2>Belum ada periode</h2>

        <p>
            Tambahkan periode PKL untuk mulai mengatur kuota.
        </p>

        <a href="{{ route('periode.create') }}">
            + Tambah Periode
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

.subtitle {
    color: #6b7280;
    font-size: 12px;
    margin-bottom: 4px;
}

.page-header h1 {
    font-size: 24px;
}

.add-btn {
    width: 42px;
    height: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #2563eb;
    color: white;

    font-size: 25px;
    text-decoration: none;
}

.success {
    padding: 12px;
    background: #dcfce7;
    color: #166534;

    border-radius: 10px;

    margin-bottom: 15px;

    font-size: 13px;
}

.period-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.period-card {
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 16px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.card-header h2 {
    font-size: 16px;
    margin-bottom: 4px;
}

.card-header p {
    font-size: 12px;
    color: #6b7280;
}

.badge {
    height: fit-content;

    padding: 5px 8px;

    border-radius: 6px;

    font-size: 9px;
    font-weight: bold;
}

.available {
    background: #dcfce7;
    color: #15803d;
}

.full {
    background: #fee2e2;
    color: #dc2626;
}

.date {
    font-size: 11px;
    color: #6b7280;

    margin-top: 15px;
}

.quota-info {
    display: flex;
    justify-content: space-between;
    align-items: end;

    margin-top: 18px;

    font-size: 11px;
}

.quota-info span {
    color: #6b7280;
}

.quota-info strong {
    display: block;
    color: #111827;
    font-size: 14px;
    margin-top: 3px;
}

.progress {
    height: 7px;

    background: #e5e7eb;

    border-radius: 10px;

    overflow: hidden;

    margin-top: 8px;
}

.progress-bar {
    height: 100%;
    background: #2563eb;

    border-radius: 10px;
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 8px;

    margin-top: 15px;
}

.actions a,
.actions button {
    padding: 7px 12px;

    border-radius: 7px;

    font-size: 11px;

    text-decoration: none;

    cursor: pointer;
}

.edit {
    background: #eff6ff;
    color: #2563eb;
}

.delete {
    border: none;

    background: #fef2f2;
    color: #dc2626;
}

.empty {
    text-align: center;

    padding: 60px 20px;
}

.empty-icon {
    font-size: 45px;
    margin-bottom: 15px;
}

.empty h2 {
    font-size: 18px;
    margin-bottom: 8px;
}

.empty p {
    color: #6b7280;
    font-size: 13px;
    line-height: 1.5;

    margin-bottom: 20px;
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

</style>

@endsection