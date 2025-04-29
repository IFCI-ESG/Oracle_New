<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP4AdditionalQuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p4_additional_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'stakeholder_group',
        'identified_yes_no',
        'channel',
        'frequency',
        'purpose',
        'created_at',
        'updated_at',
    ];

}
