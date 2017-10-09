<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'path',
    ];

    public function delete()
    {
        \File::delete($this->path);
        parent::delete();
    }

    public function download()
    {
        return url($this->path);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
