<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP8QuestionMaster extends Model
{
    protected $table = 'brsr_sectionc_p8_question_master';
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