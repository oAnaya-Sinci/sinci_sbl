<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    protected $fillable =[
        'id','id_shift','name','idgroup','condicion'
    ];
    public function user()
    {
        return $this->hasMany('App\User');
    }
}
