<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $fillable =[
        'idmachine','name','eu','condicion'
    ];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
