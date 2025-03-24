<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovernanceQuestionValue extends Model
{
    protected $table = 'governance_question_value';
    protected $fillable = [
        'id',
        'gov_mast_id',
        'com_id',
        'ques_id',
        'fy_id',
        'value',
        'details',
        'complaints',
        'no_of_complaints',
        'no_of_pending_complaints',
        'percentage',
        'policy_val',
        'fine_amt',
        'created_at',
        'updated_at'
    ];
}
