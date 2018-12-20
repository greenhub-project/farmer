<?php

namespace App\Farmer\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'active',
    ];

    /**
     * Boot the model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (self $user) {
            $user->api_token = str_random(30);
            $user->assignRole('member');
        });
    }

    public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }
}
