<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Uom;
use Illuminate\Http\Request;

class UomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $uoms = Uom::all();
        return view('admin.uoms.index',compact('uoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.uoms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:uoms,name',
        ]);

        Uom::create($validated);
        return redirect()->route('uoms.index')->with('success', 'UOM berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uom $uom)
    {
        return view('admin.uoms.edit', compact('uom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uom $uom)
    {
       $validated = $request->validate([
            'name' => 'required|unique:uoms,name,' . $uom->id,
        ]);

        $uom->update($validated);
        return redirect()->route('uoms.index')->with('success', 'UOM berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uom $uom)
    {
        $uom->delete();
        return redirect()->route('uoms.index')->with('success', 'UOM berhasil dihapus.');
    }
}
