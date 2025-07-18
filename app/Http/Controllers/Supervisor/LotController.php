<?php
namespace App\Http\Controllers\Supervisor;

use App\Models\Lot;
use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LotController extends Controller
{
    public function index()
    {
        return view('supervisor.lots.index', [
            'lots' => Lot::with('item', 'uom')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('supervisor.lots.create', [
            'items' => Item::where('type', 'raw')->with('uom')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'qty_awal' => 'required|numeric|min:0.01',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        Lot::create([
            'code' => 'LOT-' . $item->code,
            'item_id' => $item->id,
            'uom_id' => $item->uom_id,
            'qty_awal' => $validated['qty_awal'],
            'qty_sisa' => $validated['qty_awal'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('supervisor.lots.index')->with('success', 'Lot berhasil ditambahkan.');
    }

    public function edit(Lot $lot)
{
    if ($lot->qty_awal != $lot->qty_sisa) {
        return redirect()->route('supervisor.lots.index')->withErrors('Lot sudah digunakan, tidak bisa diedit.');
    }

    return view('supervisor.lots.edit', compact('lot'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lot $lot)
{
    if ($lot->qty_awal != $lot->qty_sisa) {
        return redirect()->route('supervisor.lots.index')->withErrors('Lot sudah digunakan, tidak bisa diubah.');
    }

    $validated = $request->validate([
        'item_id' => 'required|exists:items,id',
        'qty_awal' => 'required|numeric|min:0.01',
    ]);

    $item = Item::findOrFail($validated['item_id']);

    $lot->update([
        'code' => 'LOT-' . $item->code,
        'item_id' => $item->id,
        'uom_id' => $item->uom_id,
        'qty_awal' => $validated['qty_awal'],
        'qty_sisa' => $validated['qty_awal'],
    ]);

    return redirect()->route('supervisor.lots.index')->with('success', 'Lot berhasil diupdate.');
}


    public function destroy(Lot $lot)
{
    if ($lot->qty_awal != $lot->qty_sisa) {
        return redirect()->route('supervisor.lots.index')->withErrors('Lot sudah digunakan, tidak bisa dihapus.');
    }

    $lot->delete();

    return redirect()->route('supervisor.lots.index')->with('success', 'Lot berhasil dihapus.');
}

}
