@extends('layout.app')

@section('content')
    <h2>Data UOM</h2>
    <a href="{{ route('uoms.create') }}" class="btn btn-primary mb-3">+ Tambah UOM</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uoms as $uom)
                <tr>
                    <td>{{ $uom->name }}</td>
                    <td>
                        <a href="{{ route('uoms.edit', $uom) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('uoms.destroy', $uom) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
