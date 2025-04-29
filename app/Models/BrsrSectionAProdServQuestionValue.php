<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionAProdServQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_prod_serv_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'main_activity_description',
        'business_activity_description',
        'turnover_percent_entity',
        'product_service',
        'nic_code',
        'total_turnover_contributed',
        'created_at',
        'updated_at'
    ];
}