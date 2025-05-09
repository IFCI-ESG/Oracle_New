<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP6AdditionalQuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p6_additional_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'operation_name',
        'operation_type',
        'env_condition',
        'project_name',
        'eia_no',
        'date_value',
        'external_agency',
        'public_domain',
        'web_link',
        'law',
        'non_comp_details',
        'fine_penality',
        'corrective_action',
        'initative',
        'initative_details',
        'initative_outcome',
        'flag',
        'created_at',
        'updated_at',
    ];

}
