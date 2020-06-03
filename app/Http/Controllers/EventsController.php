<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Machine;
use App\Events;
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
        $idgroup = auth()->user()->idgroup;
        $pareto = DB::select('call ConsultaParetoHras(?,?,?)',array($caso,$idmachine,$date));
        $paretoGrid = DB::select('call ConsultaParetoGrid(?,?,?,?)',array($caso,$idgroup,$idmachine,$date));
            
        return array ($pareto,$paretoGrid);
    }


    public function update(Request $request)
    {
        $events = Events::findOrFail($request->id);
        $events->justification = $request->justification;
        $events->save();
        return Redirect()->route('events',['idmachine'=> $request->idmachine]);  
    }

    public function editm($id)
    {
        $events = Events::find($id);
        return response()->json($events);
    }
}