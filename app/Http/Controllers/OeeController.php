<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Machine;

class OeeController extends Controller
{
    public function index($idmachine)
    {
            $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('graphics.oee')->with(compact('machines'));
    }
}
