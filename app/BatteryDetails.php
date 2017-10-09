<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatteryDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'charger',
        'health',
        'voltage',
        'temperature',
        'capacity',
        'charge_counter',
        'current_average',
        'current_now',
        'energy_counter'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
