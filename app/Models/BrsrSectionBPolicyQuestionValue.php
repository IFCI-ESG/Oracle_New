<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionBPolicyQuestionValue extends Model
{
    protected $table = 'brsr_sectionb_policy_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'policy_p1',
        'policy_p2',
        'policy_p3',
        'policy_p4',
        'policy_p5',
        'policy_p6',
        'policy_p7',
        'policy_p8',
        'policy_p9',
        'created_at',
        'updated_at'
    ];
}