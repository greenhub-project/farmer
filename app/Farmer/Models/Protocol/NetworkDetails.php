<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class NetworkDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'network_type',
        'mobile_network_type',
        'mobile_data_status',
        'mobile_data_activity',
        'roaming_enabled',
        'wifi_status',
        'wifi_signal_strength',
        'wifi_link_speed',
        'wifi_ap_status',
        'network_operator',
        'sim_operator',
        'mcc',
        'mnc'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
