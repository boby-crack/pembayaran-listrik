@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tagihan</h1>
    <form action="{{ route('tagihans.update', $tagihan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nomor KWH -->
        <div class="form-group">
            <label for="nomor_kwh">Nomor KWH</label>
            <select name="nomor_kwh" id="nomor_kwh" class="form-control" required>
                <option value="">-- Pilih Nomor KWH --</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->nomor_kwh }}"
                        {{ $pelanggan->nomor_kwh == $tagihan->pelanggan->nomor_kwh ? 'selected' : '' }}>
                        {{ $pelanggan->nomor_kwh }} - {{ $pelanggan->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Bulan -->
        <div class="form-group">
            <label for="bulan">Bulan</label>
            <input type="text" name="bulan" id="bulan" class="form-control" value="{{ $tagihan->bulan }}" required>
        </div>

        <!-- Tahun -->
        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $tagihan->tahun }}" required>
        </div>

        <!-- Meter Awal -->
        <div class="form-group">
            <label for="meter_awal">Meter Awal</label>
            <input type="number" name="meter_awal" id="meter_awal" class="form-control" value="{{ $tagihan->penggunaan->meter_awal }}" readonly>
        </div>

        <!-- Meter Akhir -->
        <div class="form-group">
            <label for="meter_akhir">Meter Akhir</label>
            <input type="number" name="meter_akhir" id="meter_akhir" class="form-control" value="{{ $tagihan->penggunaan->meter_akhir }}" required>
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="belum lunas" {{ $tagihan->status == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                <option value="lunas" {{ $tagihan->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
    </form>
</div>
@endsection
