<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalValue extends Model
{
    protected $table = 'physical_value';
    protected $fillable = [
        'id',
        'module_mast_id',
        'com_id',
        'fy_id',
        // 'plant_location_id',
        'plant_and_risk_id',
        'created_at',
        'updated_at'
    ];
}

