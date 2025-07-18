@extends('layout.app')

@section('content')
<h2>Tambah Lot Bahan</h2>

<form action="{{ route('supervisor.lots.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Item</label>
        <select name="item_id" class="form-control" required>
            <option value="">-- Pilih Bahan Baku --</option>
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Qty Awal</label>
        <input type="number" name="qty_awal" step="0.01" class="form-control" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
