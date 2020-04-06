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
            $typeevent = TypeEvent::join('machines','type_events.idmachine','=','machines.id')
            ->select('type_events.id','type_events.idmachine','type_events.name','type_events.id_faild','type_events.description','type_events.severity','type_events.condicion','type_events.created_at','type_events.updated_at')
            ->orderBy('type_events.id', 'desc')->paginate(3);
        }
        else{
            $typeevent = TypeEvent::join('machines','type_events.idmachine','=','machines.id')
            ->select('type_events.id','type_events.idmachine','type_events.name','type_events.id_faild','type_events.description','type_events.severity','type_events.condicion','type_events.created_at','type_events.updated_at')
            ->where('type_events.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('type_events.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $typeevent->total(),
                'current_page' => $typeevent->currentPage(),
                'per_page'     => $typeevent->perPage(),
                'last_page'    => $typeevent->lastPage(),
                'from'         => $typeevent->firstItem(),
                'to'           => $typeevent->lastItem(),
            ],
            'typeevent' => $typeevent
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $typeevent = new TypeEvent();
        $typeevent->idmachine = $request->idmachine;
        $typeevent->name = $request->name;
        $typeevent->id_faild = $request->id_faild;
        $typeevent->description = $request->description;
        $typeevent->severity = $request->severity;
        $typeevent->created_at = '';
        $typeevent->condicion = '1';
        $typeevent->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->idmachine = $request->idmachine;
        $typeevent->name = $request->name; 
        $typeevent->id_faild = $request->id_faild;
        $typeevent->description = $request->description;
        $typeevent->severity = $request->severity;
        $typeevent->updated_at = '';
        $typeevent->condicion = '1';
        $typeevent->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $variable = TypeEvent::findOrFail($request->id);
        $variable->condicion = '0';
        $variable->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $variable = TypeEvent::findOrFail($request->id);
        $variable->condicion = '1';
        $variable->save();
    }


}
