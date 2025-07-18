<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionInput extends Model
{
    protected $fillable = [
    'production_id',
    'lot_id',
    'qty_used',
    'created_by',
];
    public function production() {
    return $this->belongsTo(Production::class);
}

public function lot() {
    return $this->belongsTo(Lot::class);
}

}
