<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankFinancialDetails extends Model
{
    protected $table = 'bank_financial_details';
    protected $fillable = [
        'id',
        'fy_id',
        'com_id',
        'bank_id',
        'zone',
        'borrowings',
        'bank_exposure',
        'total_equity',
        'net_revenue',
        'profit_after_tax',
        'rating',
        'rating_date',
        'rating_agency',
        'class_type_id',
        'created_at',
        'updated_at'
    ];
}
