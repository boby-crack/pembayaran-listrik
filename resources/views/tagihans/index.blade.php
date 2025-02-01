@extends('layouts.app')

@section('content')
<h1>Daftar Tagihan</h1>
<a href="{{ route('tagihans.create') }}" class="btn btn-primary mb-3">Tambah Tagihan</a>

<table class="table">
<thead>
    <tr>
        <th>Nama</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Penggunaan/ Kwh</th>
        <th>Total Tagihan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($tagihans as $tagihan)
        <tr>
            <td>{{ $tagihan->pelanggan->name ?? 'Tidak Ada Data' }}</td>
            <td>{{ $tagihan->bulan }}</td>
            <td>{{ $tagihan->tahun }}</td>
            <td>{{ $tagihan->jumlah_meter }}</td>
            <td>{{ number_format($tagihan->total_tagihan) }}</td>
            <td>
                @if($tagihan->status === 'lunas')
                    <span class="badge bg-success">Lunas</span>
                @else
                    <span class="badge bg-warning">Belum Lunas</span>
                @endif
            </td>
            <td>
              <a href="{{ route('tagihans.edit', $tagihan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('tagihans.destroy', $tagihan->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

</table>

@endsection
