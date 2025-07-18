@extends('layout.app')

@section('content')
    <h2>Edit Work Center</h2>
    <form method="POST" action="{{ route('work-centers.update', $workCenter) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $workCenter->name }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
