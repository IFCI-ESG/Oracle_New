<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP5QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p5_question_value';
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',

        'emp_tot_current_fy',
        'emp_no_current_fy',
        'emp_percent_current_fy',
        'emp_previous_fy_id',
        'emp_tot_previous_fy',
        'emp_no_previous_fy',
        'emp_percent_previous_fy',

        'wage_tot_current_fy',
        'wage_equal_no_current_fy',
        'wage_equal_percent_current_fy',
        'wage_more_no_current_fy',
        'wage_more_percent_current_fy',

        'wage_previous_fy_id',
        'wage_tot_previous_fy',
        'wage_equal_no_previous_fy',
        'wage_equal_percent_previous_fy',
        'wage_more_no_previous_fy',
        'wage_more_percent_previous_fy',

        'male_sal_number',
        'male_wages',
        'female_sal_number',
        'female_wages',

        'gross_wages_current_fy',
        'gross_wages_previous_fy',
        'gross_wages_prev_fy',

        'focal_point',
        'internal_mech',

        'compliants_filed_current_fy',
        'compliants_pending_current_fy',
        'compliants_remarks_current_fy',

        'compliants_prev_fy_id',
        'compliants_filed_previous_fy',
        'compliants_pending_previous_fy',
        'compliants_remarks_previous_fy',

        'ppr_current_fy',
        'ppr_previous_fy_id',
        'ppr_previous_fy',

        'cases',
        'contracts',
        'assessment_percent',
        'corrective_actions',
        'business_process',
        'scope_details',

        'premise',
        'value_chain_percent',
        'risk_concerns',

        'created_at',
        'updated_at'
    ];
}