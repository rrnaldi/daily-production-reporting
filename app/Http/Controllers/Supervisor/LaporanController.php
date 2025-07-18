<?php

namespace App\Http\Controllers\Supervisor;

use League\Csv\Writer;
use SplTempFileObject;
use App\Models\Production;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
     public function index()
    {
        $productions = Production::with(['user', 'workCenter'])->latest()->paginate(10);
        return view('supervisor.laporan.index', compact('productions'));
    }

    public function show($id)
    {
        $production = Production::with(['inputs.lot.item', 'outputs.lot.item', 'workCenter', 'user'])->findOrFail($id);
        return view('supervisor.laporan.show', compact('production'));
    }

    public function export($id)
{
    $production = Production::with(['inputs.lot.item', 'outputs.lot.item', 'workCenter', 'user'])->findOrFail($id);

    $csv = Writer::createFromFileObject(new SplTempFileObject());
    $csv->insertOne(['Tanggal Produksi', $production->production_date]);
    $csv->insertOne(['Work Center', $production->workCenter->name]);
    $csv->insertOne(['Operator', $production->user->name]);
    $csv->insertOne(['Shift', $production->shift ?? '-']);
    $csv->insertOne([]); // baris kosong
    $csv->insertOne(['TIPE', 'KODE LOT', 'ITEM', 'QTY', 'UOM']);

    foreach ($production->inputs as $input) {
        $csv->insertOne([
            'Input',
            $input->lot->code,
            $input->lot->item->name,
            $input->qty_used,
            $input->lot->uom->name ?? '-'
        ]);
    }

    foreach ($production->outputs as $output) {
        $csv->insertOne([
            'Output',
            $output->lot->code,
            $output->lot->item->name,
            $output->qty_output,
            $output->lot->uom->name ?? '-'
        ]);
    }

    // Set nama file
    $filename = 'laporan-produksi-' . $production->id . '.csv';

    // Outputkan sebagai file unduhan
    $csv->output($filename);
    exit;
}

public function exportAll()
{
    $productions = Production::with(['inputs.lot.item', 'outputs.lot.item', 'workCenter', 'user'])->latest()->get();

    $csv = Writer::createFromFileObject(new SplTempFileObject());
    $csv->insertOne([
        'ID Produksi', 'Tanggal', 'Shift', 'Work Center', 'Operator',
        'Tipe', 'Kode Lot', 'Nama Item', 'Qty', 'UOM'
    ]);

    foreach ($productions as $prod) {
        foreach ($prod->inputs as $input) {
            $csv->insertOne([
                $prod->id,
                $prod->production_date,
                $prod->shift,
                $prod->workCenter->name,
                $prod->user->name,
                'Input',
                $input->lot->code,
                $input->lot->item->name,
                $input->qty_used,
                $input->lot->uom->name ?? '-'
            ]);
        }

        foreach ($prod->outputs as $output) {
            $csv->insertOne([
                $prod->id,
                $prod->production_date,
                $prod->shift,
                $prod->workCenter->name,
                $prod->user->name,
                'Output',
                $output->lot->code,
                $output->lot->item->name,
                $output->qty_output,
                $output->lot->uom->name ?? '-'
            ]);
        }
    }

    $csv->output('rekap-produksi-semua.csv');
    exit;
}

}
