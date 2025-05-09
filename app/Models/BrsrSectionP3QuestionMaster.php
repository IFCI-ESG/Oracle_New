<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP3QuestionMaster extends Model
{
    protected $table = 'brsr_sectionc_p3_question_master';
    protected $fillable = [
        'id',
        'question',
        'question_section',
        'question_type',
        'status',
        'created_at',
        'updated_at'
    ];
}