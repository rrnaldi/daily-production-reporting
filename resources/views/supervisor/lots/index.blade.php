@extends('layout.app')

@section('content')
<h2>Daftar Lot</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('supervisor.lots.create') }}" class="btn btn-success mb-3">+ Tambah Lot</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode Lot</th>
            <th>Item</th>
            <th>Qty Awal</th>
            <th>Qty Sisa</th>
            <th>UOM</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lots as $lot)
            <tr>
                <td>{{ $lot->code }}</td>
                <td>{{ $lot->item->name }}</td>
                <td>{{ $lot->qty_awal }}</td>
                <td>{{ $lot->qty_sisa }}</td>
                <td>{{ $lot->uom->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('supervisor.lots.edit', $lot) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('supervisor.lots.destroy', $lot) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus lot ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
@endsection
