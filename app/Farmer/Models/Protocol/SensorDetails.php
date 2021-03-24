<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class SensorDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fifo_max_event_count',
        'fifo_reserved_event_count',
        'highest_direct_report_rate_level',
        'is_additional_info_supported',
        'is_dynamic_sensor',
        'is_wake_up_sensor',
        'max_delay',
        'maximum_range',
        'min_delay',
        'name',
        'power',            
        'reporting_mode',
        'resolution',  
        'string_type',          
        'code_type',  
        'vendor',         
        'version',            
        'frequency_of_use', 
        'ini_timestamp', 
        'end_timestamp',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
