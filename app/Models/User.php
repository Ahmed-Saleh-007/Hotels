<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable, HasRoles;
  

    /**
     * The attributes that are mass assignable.
     *
     * name
mobile
gender
avatar_image
is_approved
national_id
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'gender',
        'level',
        'avatar_image',
        'is_approved',
        'is_banned',
        'approved_by',
        'created_by',
        'national_id',
        'country',
        'email',
        'password',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
