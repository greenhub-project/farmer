<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationProvider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
