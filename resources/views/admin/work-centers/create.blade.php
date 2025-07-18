@extends('layout.app')

@section('content')
    <h2>Tambah Work Center</h2>
    <form method="POST" action="{{ route('work-centers.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
