<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionBNgrbcQuestionValue extends Model
{
    protected $table = 'brsr_sectionb_ngrbc_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'review_p1',
        'review_p2',
        'review_p3',
        'review_p4',
        'review_p5',
        'review_p6',
        'review_p7',
        'review_p8',
        'review_p9',
        'frequency_p1',
        'frequency_p2',
        'frequency_p3',
        'frequency_p4',
        'frequency_p5',
        'frequency_p6',
        'frequency_p7',
        'frequency_p8',
        'frequency_p9',
        'created_at',
        'updated_at'
    ];
}