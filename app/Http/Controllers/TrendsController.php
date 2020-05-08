<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Variable;
use DB;

class TrendsController extends Controller
{
    public function index($idvariable)
    {
            
            $date = Carbon::now();
            $date = $date->format('Y-m-d'); 
            
            $variables = Variable::where('variables.id', '=',$idvariable)
            ->join('machines','variables.idmachine','=','machines.id')
            ->select('variables.id','variables.idmachine','variables.name','variables.idmachine','machines.name as name_machine','variables.eu','variables.condicion')->get();

        return view('graphics.trends')->with(compact('variables','date'));
    }

    public function datos($idvariable,$caso,$date)
    {
            $trends = DB::select('call ConsultaTrends(?,?,?)',array($caso,$idvariable,$date));

        return $trends;
    }
}
