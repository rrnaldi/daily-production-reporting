@extends('layout.app')

@section('content')
    <h2>Data Work Center</h2>
    <a href="{{ route('work-centers.create') }}" class="btn btn-primary mb-3">+ Tambah Work Center</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workCenters as $work)
                <tr>
                    <td>{{ $work->name }}</td>
                    <td>
                        <a href="{{ route('work-centers.edit', $work) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('work-centers.destroy', $work) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
