<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP1QuestionMaster extends Model
{
    protected $table = 'brsr_sectionc_p1_question_master';
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