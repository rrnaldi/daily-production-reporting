@extends('layout.app')

@section('content')
<div class="container">
    <h2>Riwayat Produksi</h2>

    @if($productions->isEmpty())
        <p>Belum ada data produksi.</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Work Center</th>
                <th>Item Output</th>
                <th>Qty Output</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productions as $prod)
                <tr>
                    <td>{{ $prod->production_date }}</td>
                    <td>{{ $prod->workCenter->name }}</td>
                    <td>
                        @foreach($prod->outputs as $out)
                            {{ $out->lot->code }}</strong> 
                        @endforeach
                    </td>
                    <td>
                        @foreach($prod->outputs as $out)
                            {{ number_format($out->qty_output, 0) }} {{ $out->lot->item->uom->name ?? '' }}<br>
                        @endforeach
                    </td>
                    <td>
                        @if($prod->note)
                        {{ $prod->note }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
