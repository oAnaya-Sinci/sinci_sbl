<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $fillable =[
        'id','name','idmachine','id_faild','description','severity','condicion','created_at','updated_at'
    ];
    public function machine(){
        return $this->belongsTo('App\Machine');
    }
}
