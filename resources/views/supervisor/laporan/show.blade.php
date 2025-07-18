@extends('layout.app')

@section('content')
<h3>Detail Produksi</h3>
<p><strong>Tanggal:</strong> {{ $production->production_date }}</p>
<p><strong>Work Center:</strong> {{ $production->workCenter->name }}</p>
<p><strong>Operator:</strong> {{ $production->user->name }}</p>
<p><strong>Shift:</strong> {{ $production->shift }}</p>
<p><strong>Catatan:</strong> {{ $production->note ?? '-' }}</p>

<hr>
<h4>Input Lot</h4>
<table class="table table-sm">
    <thead>
        <tr>
            <th>Lot</th>
            <th>Item</th>
            <th>Qty Pakai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($production->inputs as $input)
        <tr>
            <td>{{ $input->lot->code }}</td>
            <td>{{ $input->lot->item->name }}</td>
            <td>{{ $input->qty_used }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Output</h4>
<table class="table table-sm">
    <thead>
        <tr>
            <th>Lot</th>
            <th>Item</th>
            <th>Qty Hasil</th>
        </tr>
    </thead>
    <tbody>
        @foreach($production->outputs as $output)
        <tr>
            <td>{{ $output->lot->code }}</td>
            <td>{{ $output->lot->item->name }}</td>
            <td>{{ $output->qty_output }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex mb-3">
    <a href="{{ route('supervisor.laporan.export', $production->id) }}" class="btn btn-success me-2">
        <i class="fas fa-file-csv"></i> Export CSV
    </a>
    <a href="{{ route('supervisor.laporan.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@endsection
