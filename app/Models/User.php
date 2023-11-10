<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Mprince\Pointable\Traits\Pointable as PointableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasApiTokens;
    use PointableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'provider_id',
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
    ];

    // relationBetweenInstructor
    public function relationBetweenInstructor()
    {
        return $this->hasOne(Instructor::class, 'user_id', 'id');
    }

    // relationBetweenStudent
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    // verifyUser
    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class, 'user_id', 'id');
    }

    public function scopeVerify($query)
    {
        return $query->where('verified', true);
    }

    //END
}
