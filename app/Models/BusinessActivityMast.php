<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessActivityMast extends Model
{
    protected $table = 'BUSINESSACTIVITYMASTER';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'ACITVITY',
        'SOURCE',
        'SCOPE_ID',
        'SECTOR_ID',
        'QUES_TYPE_ID',
        'STATUS'
    ];
}
