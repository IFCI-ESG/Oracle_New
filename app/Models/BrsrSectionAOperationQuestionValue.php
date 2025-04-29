<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionAOperationQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_operations_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'national_plant_count',
        'national_office_count',
        'national_total_count',
        'international_plant_count',
        'international_office_count',
        'international_total_count',
        'national_state_number',
        'international_country_number',
        'export_contribution',
        'customer_brief',
        'created_at',
        'updated_at'
    ];
}