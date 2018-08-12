<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SampleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'device_id' => $this->device_id,
            'timestamp' => $this->timestamp,
            'app_version' => $this->app_version,
            'database_version' => $this->database_version,
            'battery_state' => strtolower($this->battery_state),
            'battery_level' => $this->battery_level,
            'triggered_by' => $this->triggered_by,
            'network_status' => strtolower($this->network_status),
            'screen_brightness' => $this->screen_brightness,
            'screen_on' => $this->screen_on,
            'timezone' => $this->timezone,
            'country_code' => $this->country_code,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
