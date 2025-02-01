@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Pelanggan</h1>
    <form action="{{ route('pelanggans.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Nama -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $pelanggan->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin diubah)</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor KWH -->
            <div class="col-md-6 mb-3">
                <label for="nomor_kwh" class="form-label">Nomor KWH</label>
                <input type="text" id="nomor_kwh" name="nomor_kwh" class="form-control @error('nomor_kwh') is-invalid @enderror" value="{{ old('nomor_kwh', $pelanggan->nomor_kwh) }}" required>
                @error('nomor_kwh')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div class="col-md-6 mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" id="nomor_hp" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('nomor_hp', $pelanggan->nomor_hp) }}" required>
                @error('nomor_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="col-md-6 mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $pelanggan->alamat) }}" required>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tarif -->
            <div class="col-md-6 mb-3">
                <label for="id_tarif" class="form-label">Tarif</label>
                <select id="id_tarif" name="id_tarif" class="form-select @error('id_tarif') is-invalid @enderror" required>
                    <option value="" disabled>Pilih Tarif</option>
                    @foreach($tarifs as $tarif)
                        <option value="{{ $tarif->id }}" {{ $pelanggan->id_tarif == $tarif->id ? 'selected' : '' }}>
                            {{ $tarif->daya }} - Rp{{ number_format($tarif->tarifperkwh, 0, ',', '.') }}/kWh
                        </option>
                    @endforeach
                </select>
                @error('id_tarif')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('pelanggans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
