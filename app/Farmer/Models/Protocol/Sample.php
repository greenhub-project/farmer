<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timestamp',
        'app_version',
        'database_version',
        'battery_state',
        'battery_level',
        'memory_active',
        'memory_inactive',
        'memory_free',
        'memory_user',
        'triggered_by',
        'network_status',
        'screen_brightness',
        'screen_on',
        'timezone',
        'country_code',
    ];

    protected $casts = [
        'battery_level' => 'float',
        'screen_on' => 'boolean',
    ];

    // Helpers

    public function isScreenOn()
    {
        return $this->screen_on;
    }

    public function formattedMemoryActive()
    {
        $memory = $this->memory_active / 1024;

        if ($memory < 1024) {
            return round($memory, 2).' MB';
        } else {
            return round($memory / 1024, 2).' GB';
        }
    }

    // Relationships

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function networkDetails()
    {
        return $this->hasOne(NetworkDetails::class);
    }

    public function batteryDetails()
    {
        return $this->hasOne(BatteryDetails::class);
    }

    public function cpuStatus()
    {
        return $this->hasOne(CpuStatus::class);
    }

    public function settings()
    {
        return $this->hasOne(Settings::class);
    }

    public function storageDetails()
    {
        return $this->hasOne(StorageDetails::class);
    }

    public function locationProviders()
    {
        return $this->hasMany(LocationProvider::class);
    }

    public function processes()
    {
        return $this->hasMany(AppProcess::class);
    }

    public function sensors()
    {
        return $this->hasMany(SensorDetails::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function scopeWithAll($query)
    {
        $query->with(
            'device',
            'networkDetails',
            'batteryDetails',
            'cpuStatus',
            'settings',
            'storageDetails',
            'locationProviders',
            'processes',
            'processes.permissions',
            'sensors',
            'features'
        );
    }
}
