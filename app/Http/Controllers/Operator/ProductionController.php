<?php

namespace App\Http\Controllers\Operator;

use App\Models\Lot;
use App\Models\Item;
use App\Models\Production;
use App\Models\WorkCenter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductionInput;
use App\Models\ProductionOutput;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductionController extends Controller
{
    public function create()
{
    return view('operator.produksi.create', [
        'workCenters' => WorkCenter::all(),
        'lots' => Lot::where('qty_sisa', '>', 0)->with('item', 'uom')->get(),
        'items' => Item::whereIn('type', ['wip', 'finish'])->get(),
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'work_center_id' => 'required|exists:work_centers,id',
            'production_date' => 'required|date',
            'input_lots.*.lot_id' => 'required|exists:lots,id',
            'input_lots.*.qty_used' => 'required|numeric|min:0.01',
            'output.item_id' => 'required|exists:items,id',
            'output.qty_output' => 'required|numeric|min:0.01',
        ]);

        DB::transaction(function () use ($request) {
            $production = Production::create([
                'user_id' => auth()->id(),
                'work_center_id' => $request->work_center_id,
                'production_date' => $request->production_date,
                'shift' => $request->shift,
                'note' => $request->note,
            ]);

            // Input
            foreach ($request->input_lots as $input) {
                $lot = Lot::findOrFail($input['lot_id']);

                // Update qty sisa
                $lot->qty_sisa -= $input['qty_used'];
                $lot->save();

                ProductionInput::create([
                    'production_id' => $production->id,
                    'lot_id' => $lot->id,
                    'qty_used' => $input['qty_used'],
                ]);
            }

            // Output (buat lot baru)
            $item = Item::findOrFail($request->output['item_id']);
            $newLot = Lot::create([
                'code' => 'LOT-' . $item->code,
                'item_id' => $item->id,
                'uom_id' => $item->uom_id,
                'qty_awal' => $request->output['qty_output'],
                'qty_sisa' => $request->output['qty_output'],
                'created_by' => auth()->id(),
            ]);

            ProductionOutput::create([
                'production_id' => $production->id,
                'lot_id' => $newLot->id,
                'qty_output' => $request->output['qty_output'],
            ]);
        });

        return redirect()->route('operator.produksi.create')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function riwayat()
{
    $productions = Production::with('workCenter', 'outputs.lot.item')
        ->where('user_id', auth()->id())
        ->orderByDesc('production_date')
        ->get();

    return view('operator.produksi.riwayat', compact('productions'));
}

    }
