<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GovernanceQuestionMaster extends Model
{
    protected $table = 'governance_question_master';
    protected $fillable = [
        'id',
        'question',
        'section',
        'status',
        'created_at',
        'updated_at'
    ];
}
