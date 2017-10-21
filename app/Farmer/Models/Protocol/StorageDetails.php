<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class StorageDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'free',
        'total',
        'free_external',
        'total_external',
        'free_system',
        'total_system',
        'free_secondary',
        'total_secondary'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
