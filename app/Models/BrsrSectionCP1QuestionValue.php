<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectioncP1QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p1_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'total_training',
        'topics_principles',
        'age_percent',
        'ngrbc_principle',
        'regulatory_name',
        'amount',
        'brief_case',
        'appeal_prefered',
        'policy_description',
        'directors_current_fy',
        'directors_previous_fy_id',
        'directors_previous_fy',
        'no_compliants_current_fy',
        'remarks_compliants_current_fy',
        'compliants_previous_fy_id',
        'no_compliants_previous_fy',
        'remarks_compliants_previous_fy',
        'corrective_action',
        'account_current_fy',
        'account_previous_fy_id',
        'account_previous_fy',
        'business_current_fy',
        'business_previous_fy_id',
        'business_previous_fy',
        'entity_process',
        'created_at',
        'updated_at',
    ];
 
}
