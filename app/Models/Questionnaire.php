<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $table = 'questionnaire_details';
    protected $fillable = [
        'id',
        'part_id',
        'upload_id',
        'user_id',
        'value',
        'created_at',
        'updated_at'
    ];
}
