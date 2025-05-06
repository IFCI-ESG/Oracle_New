<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionP4QuestionMaster extends Model
{
    protected $table = 'brsr_sectionc_p4_question_master';
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