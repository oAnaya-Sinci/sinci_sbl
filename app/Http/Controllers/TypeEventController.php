<?php

namespace App\Http\Controllers;

use App\TypeEvent;
use App\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TypeEventController extends Controller
{
    public function index(Request $request)
    {

            $typeevents = TypeEvent::join('machines','type_events.idmachine','=','machines.id')
            ->select('type_events.id','type_events.idmachine','type_events.name','type_events.idmachine','machines.name as name_machine','type_events.description','type_events.severity','type_events.condicion')
            ->orderBy('type_events.id', 'desc')->get();

            $machines = Machine::where('condicion','=','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('typeevent.index')->with(compact('typeevents','machines'));
    }
    
    public function store(Request $request)
    {
        $typeevent = new TypeEvent();
        $typeevent->idmachine = $request->idmachine;
        $typeevent->name = $request->name;
        $typeevent->description = $request->description;
        $typeevent->severity = $request->severity;
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }
    public function update(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->idmachine = $request->idmachine;
        $typeevent->name = $request->name; 
        $typeevent->description = $request->description;
        $typeevent->severity = $request->severity;
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }

    public function desactivar(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->condicion = '0';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }

    public function activar(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }

}
