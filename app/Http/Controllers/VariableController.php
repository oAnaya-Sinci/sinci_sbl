<?php

namespace App\Http\Controllers;

use App\Variable;
use Illuminate\Http\Request;

class VariableController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $variables = Variable::join('machines','variables.idmachine','=','machines.id')
            ->select('variables.id','variables.idmachine','variables.highLimit','variables.lowLimit','variables.name as name_machine','variables.eu','variables.condicion')
            ->orderBy('variables.id', 'desc')->paginate(3);
        }
        else{
            $variables = Variable::join('machines','variables.idmachine','=','machines.id')
            ->select('variables.id','variables.idmachine','variables.highLimit','variables.lowLimit','variables.name as name_machine','variables.eu','variables.condicion')
            ->where('variables.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('variables.id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $variables->total(),
                'current_page' => $variables->currentPage(),
                'per_page'     => $variables->perPage(),
                'last_page'    => $variables->lastPage(),
                'from'         => $variables->firstItem(),
                'to'           => $variables->lastItem(),
            ],
            'variables' => $variables
        ];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $variable = new Variable();
        $variable->idmachine = $request->idmachine;
        $variable->name = $request->name;
        $variable->highLimit = $request->highLimit;
        $variable->lowLimit = $request->lowLimit;
        $variable->eu = $request->eu;
        $variable->condicion = '1';
        $variable->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $variable = Variable::findOrFail($request->id);
        $variable->idmachine = $request->idmachine;
        $variable->name = $request->name;
        $variable->highLimit = $request->highLimit;
        $variable->lowLimit = $request->lowLimit;
        $variable->eu = $request->eu;
        $variable->condicion = '1';
        $variable->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $variable = Variable::findOrFail($request->id);
        $variable->condicion = '0';
        $variable->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $variable = Variable::findOrFail($request->id);
        $variable->condicion = '1';
        $variable->save();
    }


}
