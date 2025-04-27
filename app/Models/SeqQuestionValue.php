<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeqQuestionValue extends Model
{
    protected $table = 'seq_question_value';
    protected $fillable = [
        'id',
        'seq_mast_id',
        'com_id',
        'ques_id',
        'fy_id',
        'calculation_type',
        'total_hector',
        'hector_cal',
        'tree_name',
        'no_of_tree',
        'gbh',
        'height',
        'created_at',
        'updated_at'
    ];
}
