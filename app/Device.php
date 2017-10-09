<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'model',
        'manufacturer',
        'brand',
        'product',
        'os_version',
        'kernel_version',
        'is_root',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uuid',
    ];

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

    public function scopeActive($query)
    {
        return $query->whereHas('samples', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDays(1));
        });
    }
}
