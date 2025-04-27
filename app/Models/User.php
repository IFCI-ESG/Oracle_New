<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'mobile',
        'mobile_verified_at',
        'pan',
        'inc_date',
        'ts_id',
        'cin_llpin',
        'reg_off_add',
        'reg_off_pin',
        'reg_off_state',
        'reg_off_city',
        'co_off_add',
        'co_off_pin',
        'co_off_state',
        'co_off_city',
        'contact_person',
        'designation',
        'contact_add',
        'isotpverified',
        'isactive',
        'isapproved',
        'created_at',
        'updated_at',
        'alternateno',
        'reg_off_district',
        'co_off_district',
        'unique_login_id',
        'sector_id',
        'zone',
        'purpose',
        'created_by',
        'long_term_borrowings',
        'bank_exposure_fy',
        'bank_exposure',
        'rating',
        'rating_date',
        'rating_agency',
        'status',
        'total_equity',
        'long_term_borrowings_20_21',
        'long_term_borrowings_21_22',
        'bank_exposure_20_21',
        'bank_exposure_21_22',
        'total_equity_20_21',
        'total_equity_21_22',
        'net_revenue_20_21',
        'net_revenue_21_22',
        'profit_after_tax_20_21',
        'profit_after_tax_21_22',
        'net_revenue',
        'profit_after_tax',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'modified_at' => 'datetime',
    ];

    public function applications()
    {
        return $this->hasMany('App\ApplicationMast', 'created_by');
    }

    public function TargetSegment()
    {
        return $this->hasOne('App\TargetSegment', 'id', 'ts_id');
    }

    public function documents()
    {
        return $this->hasMany('App\DocumentUploads', 'user_id');
    }

    public function setEligibleProductAttribute($value)
    {
        $this->attributes['eligible_product'] = implode(',', $value);
    }

    public function getEligibleProductAttribute($value)
    {
        return explode(',', $value);
    }
}
