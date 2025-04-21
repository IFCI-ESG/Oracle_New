<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoringQuestionValue extends Model
{
    protected $table = 'scoring_question_value';
    protected $fillable = [
        'id',
        'module_mast_id',
        'com_id',
        'ques_id',
        'fy_id',
        'value',
        'created_at',
        'updated_at'
    ];
}
