<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OeeController extends Controller
{
    public function index($idmachine)
    {
            $oee= $idmachine;

            // $machines = Machine::where('condicion','=','1')
            // ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('graphics.oee')->with(compact('oee'));
    }
}
