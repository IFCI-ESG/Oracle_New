<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectioncP1AwarenessQuestionValue extends Model
{
    protected $table = 'brsr_sectionc_p1_awareness_question_value';
    
    protected $fillable = [
        'brsr_mast_id',
        'com_id',
        'fy_id',
        'awareness_total',
        'topics',
        'age_percent',
        'created_at',
        'updated_at',
    ];
 
}
