<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    protected $fillable = [
    'code',
    'item_id',
    'uom_id',
    'qty_awal',
    'qty_sisa',
    'created_by',
];
   public function item() {
    return $this->belongsTo(Item::class);
}

public function uom() {
    return $this->belongsTo(Uom::class);
}
}
