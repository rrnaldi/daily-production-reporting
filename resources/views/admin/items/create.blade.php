@extends('layout.app')

@section('content')
    <h2>Tambah Item</h2>
    <form method="POST" action="{{ route('items.store') }}">
        @csrf

        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="raw">Raw</option>
                <option value="wip">WIP</option>
                <option value="finish">Finish</option>
            </select>
        </div>

        <div class="mb-3">
            <label>UOM</label>
            <select name="uom_id" class="form-control" required>
                <option value="">-- Pilih Satuan --</option>
                @foreach($uoms as $uom)
                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
@endsection
