<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable =[
        'idmachine','starTime','endTime','Type','descriptions','justification','duration'
    ];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
