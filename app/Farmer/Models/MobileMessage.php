<?php

namespace App\Farmer\Models;

use Illuminate\Database\Eloquent\Model;

class MobileMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipient',
        'type',
        'title',
        'body',
    ];
}
