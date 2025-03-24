<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    protected $table = 'bank_details';
    protected $fillable = [
        'id',
        'part_id',
        'value',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
