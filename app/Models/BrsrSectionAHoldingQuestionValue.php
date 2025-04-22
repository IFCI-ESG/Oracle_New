<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionAHoldingQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_holding_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'name_of_holding',
        'indicate_holding',
        'percent_shares',
        'business_responsibility',
        'created_at',
        'updated_at'
    ];
}