<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireMast extends Model
{
    protected $table = 'questionnaire_mast';
    protected $fillable = [
        'id',
        'comp_id',
        'e_status',
        's_status',
        'g_status',
        'bank_approval_status',
        'fy_id',
        'created_at',
        'updated_at',
        'submitted_at'
    ];
}
