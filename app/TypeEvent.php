<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $fillable =[
        'id','name','id_faild','description','severity','created_at','updated_at','condicion'
    ];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
