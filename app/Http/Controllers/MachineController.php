<?php

namespace App\Http\Controllers;

use App\Machine;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $machines = Machine::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $machines = Machine::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $machines->total(),
                'current_page' => $machines->currentPage(),
                'per_page'     => $machines->perPage(),
                'last_page'    => $machines->lastPage(),
                'from'         => $machines->firstItem(),
                'to'           => $machines->lastItem(),
            ],
            'machines' => $machines
        ];
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
        $machine->condicion = '1';
        $machine->save();
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $machine = Machine::findOrFail($request->id);
        $machine->name = $request->name;
        $machine->iduser = $request->iduser;
        $machine->condicion = '1';
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $machine = Machine::findOrFail($request->id);
        $machine->condicion = '0';
        $machine->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $machine = Machine::findOrFail($request->id);
        $machine->condicion = '1';
        $machine->save();
    }

}
