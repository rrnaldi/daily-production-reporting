@extends('layout.app')

@section('content')
    <h2>Tambah UOM</h2>
    <form method="POST" action="{{ route('uoms.store') }}">
        @csrf

        <div class="mb-3">
            <label>Satuan</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
