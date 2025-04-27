<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP7QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p7_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'affliation_no',
        'trade_no',
        'trade_reach',
        'authority_name',
        'brief_case',
        'action_taken',
        'public_policy',
        'advocacy',
        'public_domain',
        'frequency_review',
        'web_link',
        'flag',
        'created_at',
        'updated_at',
    ];

}
