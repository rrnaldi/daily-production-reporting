@extends('layout.app')

@section('content')
    <h2>Edit UOM</h2>
    <form method="POST" action="{{ route('uoms.update', $uom) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $uom->name }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
