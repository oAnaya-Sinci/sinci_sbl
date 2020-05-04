<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Machine;
use App\User;

class MachineController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $machines = Machine::join('users','users.id','=','machines.iduser')
        ->select('machines.id','machines.name','users.id as id_user','users.name as name_user','machines.condicion')->orderBy('name', 'asc')->get();
        
        $users = User::where('condicion','=','1')
        ->select('id','name')->orderBy('name', 'asc')->get();

        return view('machine.index')->with(compact('machines','users'));
    } 
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $machine = new Machine();
        $machine->name = $request->name;
        $machine->iduser = $request->iduser;
        $machine->condicion = '1';
        $machine->save();
        return Redirect::to('/machine');
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machine $machine)
    {
        $machine = Machine::findOrFail($request->id);
        $machine->name = $request->name;
        $machine->iduser = $request->iduser;
        $machine->condicion = '1';
        $machine->save();
        return Redirect::to('/machine');
    }

    public function desactivar(Request $request)
    {
        $machine = Machine::findOrFail($request->id);
        $machine->condicion = '0';
        $machine->save();
        return Redirect::to('/machine');
    }

    public function activar(Request $request)
    {
        $machine = Machine::findOrFail($request->id);
        $machine->condicion = '1';
        $machine->save();
        return Redirect::to('/machine');
    }
}
