<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RbiPillarValue extends Model
{
    protected $table = 'rbi_pillar_value';
    protected $fillable = [
        'id'
        ,'rbi_mast_id'
        ,'bank_id'
        ,'ques_id'
        ,'option'
        ,'value'
        ,'created_at'
        ,'updated_at'
    ];
}
