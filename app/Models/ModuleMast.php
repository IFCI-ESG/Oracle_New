<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleMast extends Model
{
    protected $table = 'module_mast';
    protected $fillable = [
        'id',
        'com_id',
        'status',
        'fy_id',
        'is_checked',
        'submitted_at',
        'created_at',
        'updated_at',
    ];
}