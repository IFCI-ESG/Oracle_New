<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP8AdditionalQuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p8_additional_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'project_name',
        'sia_no',
        'notify_date',
        'external_agency',
        'public_domain',
        'web_link',
        'rr_name',
        'state_name',
        'district_name',
        'affected_family',
        'paf_percent',
        'paf_amount',
        'social_details',
        'action_taken',
        'csr_state',
        'asp_district',
        'amount_spent',
        'traditional',
        'acquired',
        'benefit_shared',
        'basis_benefit',
        'authority_name',
        'brief_case',
        'corrective_action',
        'csr_project',
        'csr_persons',
        'groups_percent',
        'flag',
        'created_at',
        'updated_at',
    ];

}
