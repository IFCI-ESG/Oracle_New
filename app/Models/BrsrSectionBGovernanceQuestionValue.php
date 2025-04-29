<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionBGovernanceQuestionValue extends Model
{
    protected $table = 'brsr_sectionb_governance_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'director_statement',
        'authority_details',
        'committee',
        'created_at',
        'updated_at'
    ];
}