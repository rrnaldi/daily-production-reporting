@extends('layout.app')

@section('content')
<h2>Input Produksi Harian</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('operator.produksi.store') }}">
    @csrf

    <div class="mb-3">
        <label>Work Center</label>
        <select name="work_center_id" class="form-control" required>
            <option value="">-- Pilih Work Center --</option>
            @foreach($workCenters as $wc)
                <option value="{{ $wc->id }}">{{ $wc->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Produksi</label>
        <input type="date" name="production_date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Shift (opsional)</label>
        <input type="text" name="shift" class="form-control">
    </div>

    <hr>
    <h4>Lot Input</h4>

    <div id="input-lot-container">
        <div class="row mb-2 input-lot-group">
            <div class="col-md-6">
                <select name="input_lots[0][lot_id]" class="form-control" required>
                    <option value="">-- Pilih Lot --</option>
                    @foreach($lots as $lot)
                        <option value="{{ $lot->id }}">
                            {{ $lot->code }} ({{ $lot->item->name }} - {{ $lot->qty_sisa }} {{ $lot->uom->name ?? '' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="input_lots[0][qty_used]" step="0.01" class="form-control" placeholder="Qty Digunakan" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-input-lot">Hapus</button>
            </div>
        </div>
    </div>

    <button type="button" id="add-input-lot" class="btn btn-secondary mb-3">+ Tambah Lot Input</button>

    <hr>
    <h4>Output</h4>
    <div class="mb-3">
        <label>Item Hasil</label>
        <select name="output[item_id]" class="form-control" required>
            <option value="">-- Pilih Item --</option>
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Qty Hasil</label>
        <input type="number" name="output[qty_output]" step="0.01" class="form-control" required>
    </div>

    <button class="btn btn-primary">Simpan Produksi</button>
</form>

{{-- JS untuk tambah/hapus baris input lot --}}
<script>
    let index = 1;

    document.getElementById('add-input-lot').addEventListener('click', () => {
        const container = document.getElementById('input-lot-container');
        const newRow = document.querySelector('.input-lot-group').cloneNode(true);

        newRow.querySelectorAll('select, input').forEach(el => {
            el.name = el.name.replace(/\d+/, index);
            el.value = '';
        });

        container.appendChild(newRow);
        index++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-input-lot')) {
            const groups = document.querySelectorAll('.input-lot-group');
            if (groups.length > 1) {
                e.target.closest('.input-lot-group').remove();
            }
        }
    });
</script>
@endsection
