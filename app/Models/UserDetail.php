<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';
    protected $fillable = [
        'id',
        'part_id',
        'value',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
