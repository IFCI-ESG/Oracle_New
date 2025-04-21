<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrMast extends Model
{
    protected $table = 'brsr_mast';
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