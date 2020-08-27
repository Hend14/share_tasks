<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'group_img'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
