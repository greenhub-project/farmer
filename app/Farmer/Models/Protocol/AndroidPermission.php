<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class AndroidPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission',
    ];
}
