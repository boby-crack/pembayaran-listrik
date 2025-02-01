@extends('layouts.app')

@section('content')
<h1>Tambah Level</h1>

<form action="{{ route('levels.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nama_level">Nama Level</label>
        <input type="text" name="nama_level" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
