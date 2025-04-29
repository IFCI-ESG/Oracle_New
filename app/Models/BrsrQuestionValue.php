<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'response',
        'created_at',
        'updated_at'
    ];
}