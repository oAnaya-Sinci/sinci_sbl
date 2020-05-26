<?php

namespace App\Http\Controllers;

use App\TypeEvent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TypeEventController extends Controller
{
    public function index(Request $request)
    {

            $typeevents = TypeEvent::join('users','type_events.iduser','=','users.id')
            ->select('type_events.id','type_events.id_type','type_events.iduser','type_events.name','type_events.iduser','users.name as name_user','type_events.description','type_events.condicion')
            ->orderBy('type_events.id', 'desc')->get();

            $users = User::where('condicion','=','1')
                ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('typeevent.index')->with(compact('typeevents','users'));
    }
    
    public function store(Request $request)
    {
        $typeevent = new TypeEvent();
        $typeevent->iduser = $request->iduser;
        $typeevent->id_type = $request->id_type;
        $typeevent->name = $request->name;
        $typeevent->description = $request->description;
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }
    public function update(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->iduser = $request->iduser;
        $typeevent->name = $request->name; 
        $typeevent->description = $request->description;
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
