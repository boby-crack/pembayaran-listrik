@extends('layouts.app')

@section('title', 'Daftar Penggunaan')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Penggunaan</h1>
    <a href="{{ route('penggunaans.create') }}" class="btn btn-primary mb-3">Tambah Penggunaan</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Nomor KWH</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penggunaans as $penggunaan)
                <tr>
                    <td>{{ $loop->iteration + ($penggunaans->currentPage() - 1) * $penggunaans->perPage() }}</td>
                    <td>{{ $penggunaan->pelanggan->name ?? 'N/A' }}</td>
                    <td>{{ $penggunaan->pelanggan->nomor_kwh ?? 'N/A' }}</td>
                    <td>{{ $penggunaan->bulan }}</td>
                    <td>{{ $penggunaan->tahun }}</td>
                    <td>{{ $penggunaan->meter_awal }}</td>
                    <td>{{ $penggunaan->meter_akhir }}</td>
                    <td>
                        <a href="{{ route('penggunaans.edit', $penggunaan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('penggunaans.destroy', $penggunaan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus penggunaan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data penggunaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginasi -->
    <div class="d-flex justify-content-center mt-4">
        {{ $penggunaans->links() }}
    </div>
</div>
@endsection
