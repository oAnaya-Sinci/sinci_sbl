<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable=[
        'name','iduser', 'condicion'
    ];

    public function variables()
    {
        return $this->hasMany('App\Variable');
    }
    public function typeevents()
    {
        return $this->hasMany('App\TypeEvent');
    }
    public function user()
    {
        return $this->hasMany('App\User');
    }
}