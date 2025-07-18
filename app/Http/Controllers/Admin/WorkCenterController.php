<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkCenter;
use Illuminate\Http\Request;

class WorkCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workCenters = WorkCenter::all();
        return view('admin.work-centers.index', compact('workCenters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.work-centers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);


        WorkCenter::create($validated);
        return redirect()->route('work-centers.index')->with('success', 'Work Center berhasil ditambahkan.');
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
    public function edit(WorkCenter $workCenter)
    {
       return view('admin.work-centers.edit', compact('workCenter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkCenter $workCenter)
    {
       
        $validated = $request->validate([
            'name' => 'required',
        ]);


        $workCenter->update($validated);
        return redirect()->route('work-centers.index')->with('success', 'Work Center berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkCenter $workCenter)
    {
        $workCenter->delete();
        return redirect()->route('work-centers.index')->with('success', 'Work Center berhasil ditambahkan.');
    }
}
