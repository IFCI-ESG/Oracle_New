<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP9QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p9_question_value';
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'consumer_compliant',
        'turnover_percent',
        'received_compliants_current_fy',
        'pending_compliants_current_fy',
        'remarks_current_fy',
        'compliants_previous_fy_id',
        'received_compliants_previous_fy',
        'pending_compliants_previous_fy',
        'remarks_previous_fy',
        'instant_number',
        'recall_reason',
        'web_link',
        'corrective_actions',
        'no_instances',
        'breach_percent',
        'impact',
        'channels',
        'steps',
        'risk',
        'product_info',
    ];

}
