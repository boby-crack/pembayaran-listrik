@extends('layouts.app')

@section('content')
<h1>Edit Level</h1>

<form action="{{ route('levels.update', $level->id_level) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama_level">Nama Level</label>
        <input type="text" name="nama_level" class="form-control" value="{{ $level->nama_level }}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
