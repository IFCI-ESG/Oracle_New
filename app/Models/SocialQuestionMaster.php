<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialQuestionMaster extends Model
{
    protected $table = 'social_question_master';
    protected $fillable = [
        'id',
        'question',
        'section',
        'type',
        'status',
        'created_at',
        'updated_at'
    ];
}
