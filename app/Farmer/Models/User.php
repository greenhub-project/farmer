<?php

namespace App\Farmer\Models;

use App\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_token', 'api_token',
    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->email_token = str_random(30);
            $user->api_token = str_random(60);
        });
    }

    /**
     * Confirm the user.
     */
    public function verify()
    {
        $this->verified = true;
        $this->email_token = null;
        $this->save();
    }

    public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }
}
