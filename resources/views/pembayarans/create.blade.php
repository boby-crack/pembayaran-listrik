@extends('layouts.app')

@section('content')
<h1>Tambah Pembayaran</h1>

<form action="{{ route('pembayarans.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="id_tagihan">Tagihan</label>
        <select name="id_tagihan" class="form-control">
            @foreach($tagihans as $tagihan)
                <option value="{{ $tagihan->id }}">{{ $tagihan->bulan }} - {{ $tagihan->tahun }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="id_user">User</label>
        <select name="id_user" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
        <input type="date" name="tanggal_pembayaran" class="form-control">
    </div>
    <div class="form-group">
        <label for="bulan_bayar">Bulan Bayar</label>
        <input type="text" name="bulan_bayar" class="form-control">
    </div>
    <div class="form-group">
        <label for="biaya_admin">Biaya Admin</label>
        <input type="number" name="biaya_admin" class="form-control">
    </div>
    <div class="form-group">
        <label for="total_bayar">Total Bayar</label>
        <input type="number" name="total_bayar" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
