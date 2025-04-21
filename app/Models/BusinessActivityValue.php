<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessActivityValue extends Model
{
    protected $table = 'business_activity_value';
    protected $fillable = [
        'id',
        'com_id',
        'acitvity_id',
        'is_checked',
        'created_at',
        'updated_at'
    ];
}
