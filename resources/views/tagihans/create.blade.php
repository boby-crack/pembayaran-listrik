@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Tagihan Baru</h1>
    <form action="{{ route('tagihans.store') }}" method="POST">
    @csrf

    <!-- Pilih Nomor KWH -->
    <div class="form-group">
        <label for="nomor_kwh">Nomor KWH</label>
        <select name="nomor_kwh" id="nomor_kwh" class="form-control" required>
            <option value="">-- Pilih Nomor KWH --</option>
            @foreach($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->nomor_kwh }}">{{ $pelanggan->nomor_kwh }} - {{ $pelanggan->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Pilih Bulan & Tahun -->
    <div class="form-group">
        <label for="bulan_tahun">Bulan & Tahun</label>
        <select id="bulan_tahun" class="form-control" required>
            <option value="">-- Pilih Bulan & Tahun --</option>
        </select>
    </div>

    <!-- Hidden Fields untuk Bulan dan Tahun -->
    <input type="hidden" name="bulan" id="bulan">
    <input type="hidden" name="tahun" id="tahun">

    <!-- Hidden ID Penggunaan -->
    <input type="hidden" name="id_penggunaan" id="id_penggunaan">

    <!-- Meter Awal -->
    <div class="form-group">
        <label for="meter_awal">Meter Awal</label>
        <input type="text" name="meter_awal" id="meter_awal" class="form-control" readonly>
    </div>

    <!-- Meter Akhir -->
    <div class="form-group">
        <label for="meter_akhir">Meter Akhir</label>
        <input type="text" name="meter_akhir" id="meter_akhir" class="form-control" required>
    </div>

    <!-- Tombol Submit -->
    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nomorKwhDropdown = document.getElementById('nomor_kwh');
        const bulanTahunDropdown = document.getElementById('bulan_tahun');
        const meterAwalInput = document.getElementById('meter_awal');
        const meterAkhirInput = document.getElementById('meter_akhir');
        const idPenggunaanInput = document.getElementById('id_penggunaan');
        const bulanInput = document.getElementById('bulan');
        const tahunInput = document.getElementById('tahun');

        // Ambil Bulan & Tahun Berdasarkan Nomor KWH
        nomorKwhDropdown.addEventListener('change', function () {
            const nomorKwh = this.value;
            bulanTahunDropdown.innerHTML = '<option value="">-- Pilih Bulan & Tahun --</option>';

            if (nomorKwh) {
                fetch(`/tagihans/get-bulan-tahun/${nomorKwh}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(item => {
                            bulanTahunDropdown.innerHTML += `
                                <option value="${item.bulan}-${item.tahun}">
                                    ${item.bulan} - ${item.tahun}
                                </option>`;
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data Bulan & Tahun');
                    });
            }
        });

        // Ambil Meter Awal, Meter Akhir, dan ID Penggunaan Berdasarkan Bulan & Tahun
        bulanTahunDropdown.addEventListener('change', function () {
            const nomorKwh = nomorKwhDropdown.value;
            const [bulan, tahun] = this.value.split('-');

            if (bulan && tahun) {
                fetch(`/tagihans/get-penggunaan/${nomorKwh}/${bulan}/${tahun}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }

                        idPenggunaanInput.value = data.id_penggunaan;
                        meterAwalInput.value = data.meter_awal;
                        meterAkhirInput.value = data.meter_akhir;

                        // Isi field hidden bulan & tahun
                        bulanInput.value = bulan;
                        tahunInput.value = tahun;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data Penggunaan');
                    });
            }
        });
    });
</script>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
