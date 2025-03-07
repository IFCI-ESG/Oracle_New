<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnsdgValue extends Model
{
    protected $table = 'unsdg_value';
    protected $fillable = [
        'id',
        'com_id',
        'part_id',
        'value',
        'fy_id',
        'created_at',
        'updated_at'
    ];
}
