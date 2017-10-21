<?php

namespace App\Farmer\Models\Protocol;

use Illuminate\Database\Eloquent\Model;

class AppProcess extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'process_id',
        'name',
        'application_label',
        'is_system_app',
        'importance',
        'version_name',
        'version_code',
        'installation_package'
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function permissions()
    {
        return $this->hasMany(AppPermission::class);
    }
}
