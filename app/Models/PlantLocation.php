<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantLocation extends Model
{
    protected $table = 'plant_locations';
    protected $fillable = [
        'id',
        'user_id',
        'plnt_address',
        'plnt_pincode',
        'plnt_state',
        'plnt_city',
        'status',
        'created_at',
        'updated_at'
    ];
}
