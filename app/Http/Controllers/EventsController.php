<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index($idmachine)
    {
            $events= $idmachine;

            // $machines = Machine::where('condicion','=','1')
            // ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('graphics.oee')->with(compact('events'));
    }
}
