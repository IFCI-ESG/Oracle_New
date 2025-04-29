<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP2QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p2_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'capex_current_fy',
        'capex_previous_fy_id',
        'capex_previous_fy',
        'capex_details',
        'entity_procedure',
        'input_percent',
        'reclaim_product',
        'epr',
        'reuse_current_fy',
        'recycle_current_fy',
        'disposed_current_fy',
        'reuse_previous_fy_id',
        'reuse_previous_fy',
        'recycle_previous_fy',
        'disposed_previous_fy',
        'created_at',
        'updated_at',
    ];

}
