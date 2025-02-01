@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pelanggan</h1>
    <a href="{{ route('pelanggans.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor KWH</th>
                <th>Nomor HP</th>
                <th>Alamat</th>
                <th>Tarif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggans as $pelanggan)
                <tr>
                    <td>{{ $loop->iteration + ($pelanggans->currentPage() - 1) * $pelanggans->perPage() }}</td>
                    <td>{{ $pelanggan->name }}</td>
                    <td>{{ $pelanggan->nomor_kwh }}</td>
                    <td>{{ $pelanggan->nomor_hp }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                    <td>{{ $pelanggan->tarif->daya ?? 'N/A' }} - Rp{{ number_format($pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.') }}/kWh</td>
                    <td>
                        <a href="{{ route('pelanggans.edit', $pelanggan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pelanggans.destroy', $pelanggan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $pelanggans->links() }}
    </div>
</div>
@endsection
