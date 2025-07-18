<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductionOutput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductionSummaryController extends Controller
{
    public function summary(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $data = ProductionOutput::selectRaw('productions.production_date as tanggal, SUM(qty_output) as total_output')
        ->join('productions', 'production_outputs.production_id', '=', 'productions.id')
        ->whereBetween('productions.production_date', [$request->start, $request->end])
        ->groupBy('productions.production_date')
        ->orderBy('productions.production_date')
        ->get();


        return response()->json($data);
    }
}
