<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class AppPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission',
    ];

    public function process()
    {
        return $this->belongsTo(AppProcess::class);
    }
}
