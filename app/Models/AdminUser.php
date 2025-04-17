<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
class AdminUser extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;
     protected $table = 'users';
    
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $nextId = DB::select('SELECT USERS_SEQ.NEXTVAL AS ID FROM DUAL');
            $model->id = $nextId[0]->id;
        });
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'pan',
        'password',
        'remember_token',
        'contact_person',
        'designation',
        'mobile',
        'alternateno',
        'ifsc_code',
        'full_address',
        'pincode',
        'state',
        'city',
        'district',
        'services',
        'created_by',
        'isactive',
        'created_at',
        'updated_at',
        'micr_code',
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


    public function documents()
    {
        return $this->hasMany('App\DocumentUploads', 'user_id');
    }

    // public function hasRole($role)
    // {
    //     return $this->roles()->where('name', $role)->exists();
    // }


}
