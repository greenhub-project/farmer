<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SampleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'timestamp' => $request->timestamp,
            'app_version' => $request->app_version,
            'database_version' => $request->database_version,
            'battery_state' => $this->data['batteryState'],
            'battery_level' => $this->data['batteryLevel'],
            'memory_active' => $this->data['memoryActive'],
            'memory_inactive' => $this->data['memoryInactive'],
            'memory_free' => $this->data['memoryFree'],
            'memory_user' => $this->data['memoryUser'],
            'triggered_by' => $this->data['triggeredBy'],
            'network_status' => $this->data['networkStatus'],
            'screen_brightness' => $this->data['screenBrightness'],
            'screen_on' => $this->data['screenOn'],
            'timezone' => $this->data['timeZone'],
            'country_code' => $this->data['countryCode']
        ];
    }
}
