<?php

namespace App\Farmer\Models\Protocol;

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

    protected $casts = [
        'is_root' => 'boolean',
    ];

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

    public function isActive()
    {
        return (bool) $this->samples()
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();
    }

    public function scopeActive($query)
    {
        $yesterday = Carbon::now()->subHours(24);

        return $query->whereHas('samples', function ($query) use ($yesterday) {
            $query->where('created_at', '>=', $yesterday);
        });
    }
}
