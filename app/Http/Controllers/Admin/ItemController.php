<?php

namespace App\Http\Controllers\Admin;

use App\Models\Uom;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('code', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
    }

    $items = $query->paginate(10); // Atau sesuai kebutuhan

    return view('admin.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        $uoms = Uom::all();
        return view('admin.items.create', compact('uoms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:items,code',
            'name' => 'required',
            'type' => 'required|in:raw,wip,finish',
            'uom_id' => 'required|exists:uoms,id',

        ]);

        Item::create($validated);
        return redirect()->route('items.index')->with('succes', 'Item Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $uoms = Uom::all();
        return view('admin.items.edit', compact('item', 'uoms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'code' => 'required|unique:items,code,' . $item->id,
            'name' => 'required',
            'type' => 'required|in:raw,wip,finish',
            'uom_id' => 'required|exists:uoms,id',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $dipakaiDiLot = $item->lots()->exists();
        $dipakaiSebagaiInput = $item->productionInputs()->exists();
        $dipakaiSebagaiOutput = $item->productionOutputs()->exists();

        if ($dipakaiDiLot || $dipakaiSebagaiInput || $dipakaiSebagaiOutput) {
            return redirect()->route('items.index')->with('error', 'Item tidak bisa dihapus karena sudah digunakan dalam data produksi atau lot.');
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
    }

}
