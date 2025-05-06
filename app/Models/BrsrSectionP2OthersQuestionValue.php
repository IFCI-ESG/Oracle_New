<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP2OthersQuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p2_others_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'nic_code',
        'product_name',
        'turnover_contribution',
        'assessment',
        'external_agency',
        'results',
        'service_name',
        'risk_concern',
        'action_taken',
        'input_material',
        'recycle_current_fy',
        'recycle_previous_fy',
        'product_category',
        'recliam_product',
        'flag',
        'created_at',
        'updated_at',
    ];
    

}
