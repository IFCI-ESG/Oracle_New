<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RbiDisclosureMast extends Model
{
    protected $table = 'rbi_disclosure_mast';
    protected $fillable = [
        'id',
        'com_id',
        'status',
        'fy_id',
        'submitted_at',
        'created_at',
        'updated_at',
    ];
}
