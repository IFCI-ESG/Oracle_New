<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectioncP1CaseQuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p1_case_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'case_details',
        'regulatory_name',
        'created_at',
        'updated_at',
    ];
 
}
