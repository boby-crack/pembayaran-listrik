@extends('layouts.app')

@section('content')
<h1>Edit Penggunaan</h1>

<form action="{{ route('penggunaans.update', $penggunaan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Nomor KWH -->
    <div class="form-group">
        <label for="nomor_kwh">Nomor KWH</label>
        <select name="nomor_kwh" id="nomor_kwh" class="form-control" required>
            <option value="">-- Pilih Nomor KWH --</option>
            @foreach($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->nomor_kwh }}" {{ $pelanggan->nomor_kwh == $penggunaan->pelanggan->nomor_kwh ? 'selected' : '' }}>{{ $pelanggan->nomor_kwh }}</option>
            @endforeach
        </select>
        @error('nomor_kwh')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- ID Pelanggan (Hidden) -->
    <input type="hidden" name="id_pelanggan" id="id_pelanggan" value="{{ $penggunaan->id_pelanggan }}">

    <!-- Bulan -->
    <div class="form-group">
        <label for="bulan">Bulan</label>
        <input type="number" name="bulan" id="bulan" class="form-control" value="{{ $penggunaan->bulan }}" readonly>
    </div>

    <!-- Tahun -->
    <div class="form-group">
        <label for="tahun">Tahun</label>
        <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $penggunaan->tahun }}" required>
    </div>

    <!-- Meter Awal -->
    <div class="form-group">
        <label for="meter_awal">Meter Awal</label>
        <input type="number" name="meter_awal" id="meter_awal" class="form-control" value="{{ $penggunaan->meter_awal }}" readonly>
    </div>

    <!-- Meter Akhir -->
    <div class="form-group">
        <label for="meter_akhir">Meter Akhir</label>
        <input type="number" name="meter_akhir" id="meter_akhir" class="form-control" value="{{ $penggunaan->meter_akhir }}" required>
    </div>

    <!-- Tombol Submit -->
    <button type="submit" class="btn btn-primary">Perbarui</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nomorKwhDropdown = document.getElementById('nomor_kwh');
        const idPelangganInput = document.getElementById('id_pelanggan');
        const meterAwalInput = document.getElementById('meter_awal');
        const bulanInput = document.getElementById('bulan');

        nomorKwhDropdown.addEventListener('change', function () {
            const nomorKwh = this.value;

            if (nomorKwh) {
                // Fetch ID Pelanggan dan Meter Awal
                fetch(`/penggunaans/get-meter-awal/${nomorKwh}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            meterAwalInput.value = 0;
                        } else {
                            meterAwalInput.value = data.meter_awal;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data Meter Awal');
                    });

                // Fetch Bulan
                fetch(`/penggunaans/get-bulan/${nomorKwh}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            bulanInput.value = 1;
                        } else {
                            bulanInput.value = data.bulan;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data Bulan');
                    });
            } else {
                meterAwalInput.value = '';
                bulanInput.value = '';
            }
        });
    });
</script>
@endsection
