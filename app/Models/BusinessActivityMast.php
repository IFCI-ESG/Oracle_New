<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessActivityMast extends Model
{
    protected $table = 'business_activity_master';
    protected $fillable = [
        'id',
        'acitvity',
        'source',
        'scope_id',
        'sector_id',
        'status'
    ];
}
