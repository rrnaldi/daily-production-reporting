@extends('layout.app')

@section('content')
<h2>Riwayat Produksi</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Work Center</th>
            <th>Shift</th>
            <th>Operator</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productions as $p)
        <tr>
            <td>{{ $p->production_date }}</td>
            <td>{{ $p->workCenter->name }}</td>
            <td>{{ $p->shift }}</td>
            <td>{{ $p->user->name }}</td>
            <td>
                <a href="{{ route('supervisor.laporan.show', $p->id) }}" class="btn btn-sm btn-info">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('supervisor.laporan.exportAll') }}" class="btn btn-success mb-3">
    <i class="fas fa-file-csv"></i> Export CSV
</a>


{{ $productions->links() }}
@endsection
