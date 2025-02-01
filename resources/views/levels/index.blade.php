@extends('layouts.app')

@section('content')
<h1>Daftar Level</h1>
<a href="{{ route('levels.create') }}" class="btn btn-primary mb-3">Tambah Level</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Level</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($levels as $level)
        <tr>
            <td>{{ $level->id_level }}</td>
            <td>{{ $level->nama_level }}</td>
            <td>
                <a href="{{ route('levels.edit', $level->id_level) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('levels.destroy', $level->id_level) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
