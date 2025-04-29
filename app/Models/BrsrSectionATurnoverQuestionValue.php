<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionATurnoverQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_turnover_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'current_turnover_male',
        'current_turnover_female',
        'current_turnover_total',
        'previous_fy_id',
        'previous_turnover_male',
        'previous_turnover_female',
        'previous_turnover_total',
        'priorprev_fy_id',
        'priorprev_turnover_male',
        'priorprev_turnover_female',
        'priorprev_turnover_total',
        'created_at',
        'updated_at'
    ];
}