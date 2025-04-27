<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AdditionalDetails extends Model
{
    protected $table = 'additional_details';
    protected $fillable = [
        'id',
        'user_id',
        'project_name',
        'business_nature',
        'project_activity',
        'reg_address',
        'pincode',
        'state',
        'district',
        'status',
        'created_at',
        'updated_at'
    ];
}
