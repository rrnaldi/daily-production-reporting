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
}
