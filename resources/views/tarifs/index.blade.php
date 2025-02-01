@extends('layouts.app')

@section('content')
<h1>Daftar Tarif</h1>
<a href="{{ route('tarifs.create') }}" class="btn btn-primary mb-3">Tambah Tarif</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Daya</th>
            <th>Tarif Per kWh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tarifs as $tarif)
        <tr>
            <td>{{ $tarif->id }}</td>
            <td>{{ $tarif->daya }}</td>
            <td>{{ $tarif->tarifperkwh }}</td>
            <td>
                <a href="{{ route('tarifs.edit', $tarif->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tarifs.destroy', $tarif->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
