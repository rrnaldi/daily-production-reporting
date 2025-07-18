@extends('layout.app')

@section('content')
    <h2>Data Item</h2>
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">+ Tambah Item</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('items.index') }}" method="GET" class="mb-4 d-flex align-items-center gap-2">
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari Item"
        class="form-control">

    <button type="submit" class="btn btn-primary text-white">
        Cari
    </button>

   @if(request('search'))
        <a href="{{ route('items.index') }}" class="btn btn-primary text-sm text-white ms-2">Reset</a>
    @endif
   </form>
 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Type</th>
                <th>UOM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td>{{ $item->uom->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus data?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
