<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionACompliaceQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_compliace_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'ques_id',
        'grievance_redressal',
        'current_fy_no_of_compliants',
        'current_no_of_pending_compliants',
        'current_fy_remarks',
        'previous_fy_no_of_compliants',
        'previous_no_of_pending_compliants',
        'previous_fy_remarks',
        'created_at',
        'updated_at'
    ];
}