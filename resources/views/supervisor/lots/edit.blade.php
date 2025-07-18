@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Lot</h2>

    {{-- Notifikasi sukses/error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('supervisor.lots.update', $lot) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Dropdown Item --}}
        <div class="mb-3">
            <label for="item_id" class="form-label">Item</label>
            <select name="item_id" id="item_id" class="form-control" required>
                @foreach(\App\Models\Item::where('type', 'raw')->with('uom')->get() as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $lot->item_id ? 'selected' : '' }}>
                        {{ $item->code }} - {{ $item->name }} ({{ $item->uom->name ?? '-' }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Qty Awal --}}
        <div class="mb-3">
            <label for="qty_awal" class="form-label">Qty Awal</label>
            <input type="number" name="qty_awal" id="qty_awal" class="form-control" value="{{ $lot->qty_awal }}" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Lot</button>
        <a href="{{ route('supervisor.lots.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
