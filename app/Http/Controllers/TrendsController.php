<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendsController extends Controller
{
    public function index($idvariable)
    {
            $trends = $idvariable;

            // $machines = Machine::where('condicion','=','1')
            // ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('graphics.trends')->with(compact('trends'));
    }
}
