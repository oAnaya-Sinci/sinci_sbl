<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Machine;
use DB;

class EventsController extends Controller
{
    public function index($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

            $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('graphics.event')->with(compact('machines', 'date'));
    }

    public function datos($idmachine,$caso,$date)
    {
        
        $pareto = DB::select('call ConsultaPareto(?,?,?)',array($caso,$idmachine,$date));
            
        return  ($pareto);
    }
}