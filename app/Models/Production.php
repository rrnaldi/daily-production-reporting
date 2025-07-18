<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $fillable = [
    'user_id',
    'work_center_id',
    'production_date',
    'shift',
    'note',
    'created_by',
];
    public function user() {
    return $this->belongsTo(User::class);
}

public function workCenter() {
    return $this->belongsTo(WorkCenter::class);
}

public function outputs()
{
    return $this->hasMany(\App\Models\ProductionOutput::class);
}

public function inputs()
{
    return $this->hasMany(\App\Models\ProductionInput::class);
}

}
