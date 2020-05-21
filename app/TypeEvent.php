<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $fillable =[
        'id','id_type','name','idmachine','description','condicion','created_at','updated_at'
    ];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
