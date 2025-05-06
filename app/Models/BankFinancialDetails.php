<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankFinancialDetails extends Model
{
    protected $table = 'bank_financial_details';
    protected $fillable = [
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

    // Disable auto-incrementing as we'll use Oracle sequence
    public $incrementing = false;
    
    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Get next sequence value from Oracle
            $sequence = \DB::selectOne("SELECT BANK_FINANCIAL_DETAILS_SEQ.NEXTVAL AS ID FROM DUAL");
            $model->id = $sequence->id;
        });
    }
}
