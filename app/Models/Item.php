<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['code', 'name', 'type', 'uom_id'];

    public function uom()
    {
        return $this->belongsTo(Uom::class);
    }

    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    public function productionInputs()
    {
        return $this->hasManyThrough(ProductionInput::class, Lot::class);
    }

    public function productionOutputs()
    {
        return $this->hasManyThrough(ProductionOutput::class, Lot::class);
    }

}
