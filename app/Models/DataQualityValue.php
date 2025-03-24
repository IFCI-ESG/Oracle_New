<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataQualityValue extends Model
{
    protected $table = 'data_quality_value';
    protected $fillable = [
        'id',
        'com_id',
        'fy_id',
        'segment_id',
        'data_quality_id',
        'created_at',
        'updated_at'
    ];
}
