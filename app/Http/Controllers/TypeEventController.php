<?php

namespace App\Http\Controllers;

use App\TypeEvent;
use Illuminate\Http\Request;

class TypeEventController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $typeevents = TypeEvent::join('machines','type_events.idmachine','=','machines.id')
            ->select('type_events.id','type_events.idmachine','type_events.name','machines.name as name_machine','type_events.description','type_events.severity','type_events.condicion','type_events.created_at','type_events.updated_at')
            ->orderBy('type_events.id', 'desc')->paginate(3);
        }
        else{
            $typeevents = TypeEvent::join('machines','type_events.idmachine','=','machines.id')
            ->select('type_events.id','type_events.idmachine','type_events.name','machines.name as name_machine','type_events.description','type_events.severity','type_events.condicion','type_events.created_at','type_events.updated_at')
            ->where('type_events.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('type_events.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $typeevents->total(),
                'current_page' => $typeevents->currentPage(),
                'per_page'     => $typeevents->perPage(),
                'last_page'    => $typeevents->lastPage(),
                'from'         => $typeevents->firstItem(),
                'to'           => $typeevents->lastItem(),
            ],
            'type_events' => $typeevents
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $typeevent = new TypeEvent();
        $typeevent->idmachine = $request->idmachine;
        $typeevent->name = $request->name;
        $typeevent->description = $request->description;
        $typeevent->severity = $request->severity;
        $typeevent->condicion = '1';
        $typeevent->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $typeevent = TypeEvent::findOrFail($request->id);
        //$now = new \DateTime();
        $typeevent->idmachine = $request->idmachine;
        $typeevent->name = $request->name; 
        $typeevent->description = $request->description;
        $typeevent->severity = $request->severity;
        //$typeevent->updated_at = $now->format('d-m-Y H:i:s');
        $typeevent->condicion = '1';
        $typeevent->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->condicion = '0';
        $typeevent->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->condicion = '1';
        $typeevent->save();
    }


}
