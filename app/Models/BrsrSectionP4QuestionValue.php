<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP4QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p4_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'process_key',
        'consultation',
        'stakeholder_consultation',
        'stakeholder_groups',
        'created_at',
        'updated_at',
    ];

}
