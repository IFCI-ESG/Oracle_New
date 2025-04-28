<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP8QuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p8_question_value';
 
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'community',
        'input_material_current_fy',
        'input_material_previous_fy_id',
        'input_material_previous_fy',
        'location_current_fy',
        'location_previous_fy_id',
        'location_previous_fy',
        'preferential_policy',
        'vulnerable_groups',
        'total_procurement',
        'created_at',
        'updated_at',
    ];

}
