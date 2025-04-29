<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP9QuestionMaster extends Model
{
    protected $table = 'brsr_sectionc_p9_question_master';
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