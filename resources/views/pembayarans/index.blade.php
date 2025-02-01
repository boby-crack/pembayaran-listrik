@extends('layouts.app')

@section('content')
<h1>Daftar Pembayaran</h1>
<a href="{{ route('pembayarans.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tagihan</th>
            <th>User</th>
            <th>Tanggal Pembayaran</th>
            <th>Bulan Bayar</th>
            <th>Biaya Admin</th>
            <th>Total Bayar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayarans as $pembayaran)
        <tr>
            <td>{{ $pembayaran->id }}</td>
            <td>{{ $pembayaran->id_tagihan }}</td>
            <td>{{ $pembayaran->id_user }}</td>
            <td>{{ $pembayaran->tanggal_pembayaran }}</td>
            <td>{{ $pembayaran->bulan_bayar }}</td>
            <td>{{ number_format($pembayaran->biaya_admin, 0, ',', '.') }}</td>
            <td>{{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('pembayarans.edit', $pembayaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('pembayarans.destroy', $pembayaran->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
