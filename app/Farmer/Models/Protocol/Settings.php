<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bluetooth_enabled',
        'location_enabled',
        'power_saver_enabled',
        'flashlight_enabled',
        'nfc_enabled',
        'unknown_sources',
        'developer_mode'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
