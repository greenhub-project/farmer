<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BatteryDetailsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'charger' => $this->charger,
            'health' => $this->health,
            'voltage' => $this->voltage,
            'temperature' => $this->temperature,
            'charge_counter' => $this->charge_counter,
            'current_average' => $this->current_average,
            'current_now' => $this->current_now,
            'energy_counter' => $this->energy_counter,
        ];
    }
}
