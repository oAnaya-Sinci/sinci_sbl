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
            ->select('variables.id','variables.idmachine','variables.highLimit','variables.lowLimit','variables.name','machines.name as name_machine','variables.eu','variables.condicion')
            ->orderBy('variables.id', 'desc')->paginate(50);
        }
        else{
            $variables = Variable::join('machines','variables.idmachine','=','machines.id')
            ->select('variables.id','variables.idmachine','variables.highLimit','variables.lowLimit','variables.name','machines.name as name_machine','variables.eu','variables.condicion')
            ->where('variables.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('variables.id', 'desc')->paginate(50);
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

    public function listVaribles($id_maquines){
        $id = auth()->user()->id; 
        $variables = Variable::where('idmachine', '=',$id_maquines)
            ->select('id','name')
            ->orderBy('id', 'asc')->get();
        return  $variables;
    }

    public function datos_var (){
        $anio=date('Y');
        $oees=DB::table('oee as i')
        ->select(DB::raw('TIMESTAMP(i.capturedTime) as mes'),
        DB::raw('TIMESTAMP(i.capturedTime) as anio'),
        DB::raw('SUM(i.total) as total'))
        ->whereYear('i.capturedTime',$anio)
        ->groupBy(DB::raw('TIMESTAMP(i.capturedTime)'),DB::raw('TIMESTAMP(i.capturedTime)'))
        ->get();

        return ['oees'=>$oees,'anio'=>$anio];  
    }


}
