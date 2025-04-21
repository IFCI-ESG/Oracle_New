<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputSheetMast extends Model
{
    protected $table = 'inputsheet_mast';
    protected $fillable = [
        'id',
        'com_id',
        'status',
        'fy_id',
        'created_at',
        'updated_at',
        'is_checked',
        'submitted_at',
        'undertaking_doc_id'
    ];
}
