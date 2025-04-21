<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransitionQuestionValue extends Model
{
    protected $table = 'transition_question_value';
    protected $fillable = [
        'id',
        'module_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'value',
        'created_at',
        'updated_at'
    ];
}
