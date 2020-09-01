<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrendsExport;
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
            ->select('variables.id','variables.idmachine','variables.name','variables.description','variables.idmachine','machines.name as name_machine','variables.eu','variables.condicion')->get();

        return view('graphics.trends')->with(compact('variables','date'));
    }

    public function datos($idvariable,$caso,$date)
    {
            $trends = DB::select('call ConsultaTrends(?,?,?)',array($caso,$idvariable,$date));

        return $trends;
    }

    public function monitoreo($id)
    {
            $date = Carbon::now();
            $date = $date->format('Y-m-d H:i'); 
            $monitoreo = DB::select('call ConsultaMonitoreovar(?)',array($date));

         return $monitoreo;
    }
    public function export($caso,$date,$idvar,$nomvar)
    {
        return (new TrendsExport)->datos($caso,$date,$idvar,$nomvar)->download("ReporteTrends$nomvar$date.xlsx");
    }
}
