@extends('layouts.app')

@section('content')
<h1>Edit Pembayaran</h1>

<form action="{{ route('pembayarans.update', $pembayaran->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="id_tagihan">Tagihan</label>
        <select name="id_tagihan" class="form-control">
            @foreach($tagihans as $tagihan)
                <option value="{{ $tagihan->id }}" @if($tagihan->id == $pembayaran->id_tagihan) selected @endif>
                    {{ $tagihan->bulan }} - {{ $tagihan->tahun }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="id_user">User</label>
        <select name="id_user" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}" @if($user->id == $pembayaran->id_user) selected @endif>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
        <input type="date" name="tanggal_pembayaran" class="form-control" value="{{ $pembayaran->tanggal_pembayaran }}">
    </div>
    <div class="form-group">
        <label for="bulan_bayar">Bulan Bayar</label>
        <input type="text" name="bulan_bayar" class="form-control" value="{{ $pembayaran->bulan_bayar }}">
    </div>
    <div class="form-group">
        <label for="biaya_admin">Biaya Admin</label>
        <input type="number" name="biaya_admin" class="form-control" value="{{ $pembayaran->biaya_admin }}">
    </div>
    <div class="form-group">
        <label for="total_bayar">Total Bayar</label>
        <input type="number" name="total_bayar" class="form-control" value="{{ $pembayaran->total_bayar }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
