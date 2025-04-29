<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionAMaterialQuestionValue extends Model
{
    protected $table = 'brsr_sectiona_material_question_value';
    protected $fillable = [
        'id',
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'material_issue',
        'indicate_risk',
        'identify_risk',
        'approach_adapt',
        'financial_implications',
        'created_at',
        'updated_at'
    ];
}