<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeqQuestionMaster extends Model
{
    protected $table = 'seq_question_master';
    protected $fillable = [

        'question',
        'section',
        'status',
        'created_at',
        'updated_at'
    ];
}
