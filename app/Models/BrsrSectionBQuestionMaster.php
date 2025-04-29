<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionBQuestionMaster extends Model
{
    protected $table = 'brsr_sectionb_ques_master';
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