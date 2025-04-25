<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrsrSectionAQuestionMaster extends Model
{
    protected $table = 'brsr_sectiona_question_master';
    
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