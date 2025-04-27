<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $table = 'otps';
    protected $fillable = [
        'id',
        'name',
        'mobile',
        'created_at',
        'updated_at'
    ];
}
