<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Machine;
use DB;

class OeeController extends Controller
{
    public function index($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('graphics.oee')->with(compact('machines','date'));
    }

    public function datos($idmachine,$caso,$date)
    {
            
            $oee = DB::select('call ConsultaOEETrends(?,?,?)',array($caso,$idmachine,$date));
            $oeepro = DB::select('call ConsultaOEEDoughnut(?,?,?)',array($caso,$idmachine,$date));
        return array ($oee,$oeepro);
    }
}
