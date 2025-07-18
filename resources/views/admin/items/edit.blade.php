@extends('layout.app')

@section('content')
    <h2>Edit Item</h2>
    <form method="POST" action="{{ route('items.update', $item) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="code" value="{{ $item->code }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="raw" {{ $item->type === 'raw' ? 'selected' : '' }}>Raw</option>
                <option value="wip" {{ $item->type === 'wip' ? 'selected' : '' }}>WIP</option>
                <option value="finish" {{ $item->type === 'finish' ? 'selected' : '' }}>Finish</option>
            </select>
        </div>

        <div class="mb-3">
            <label>UOM</label>
            <select name="uom_id" class="form-control" required>
                @foreach($uoms as $uom)
                    <option value="{{ $uom->id }}" {{ $uom->id == $item->uom_id ? 'selected' : '' }}>
                        {{ $uom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
