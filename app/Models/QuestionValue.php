<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionValue extends Model
{
    protected $table = 'question_value';
    protected $fillable = [
        'id',
        'com_id',
        'header_id',
        'ques_id',
        'is_checked',
        'value',
        'fy_id',
        'created_at',
        'updated_at'
    ];
}
