<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PillarValue extends Model
{
    protected $table = 'pillar_value';
    protected $fillable = [
        'id',
        'com_id',
        'ques_id',
        'pillar_id',
        'value',
        'created_at',
        'updated_at'
    ];
}
