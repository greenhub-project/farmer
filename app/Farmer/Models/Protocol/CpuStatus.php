<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class CpuStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usage',
        'up_time',
        'sleep_time',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
