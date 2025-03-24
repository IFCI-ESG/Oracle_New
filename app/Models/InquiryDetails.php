<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryDetails extends Model
{
    protected $table = 'inquiry_details';
    protected $fillable = [
        'id',
        'name',
        'email',
        'services',
        'mobile',
        'message',
        'created_at',
        'updated_at'
    ];
}
