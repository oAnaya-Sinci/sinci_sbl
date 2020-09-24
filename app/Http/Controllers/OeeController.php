<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OeeExport;
use Carbon\Carbon;
use App\Machine;
use DB;

class OeeController extends Controller
{
    public function index($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $caso = "d";

        $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
        
       
        return view('graphics.oee')->with(compact('machines','date'));
    }

    public function datos($idmachine,$caso,$date,$casoS)
    {    
            $partId = '0';
            $lotId ='0';
            $idShift = 1; 
            $idgroup = auth()->user()->idgroup;
            $oee = DB::select('call ConsultaOEETrends(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeepro = DB::select('call ConsultaOEEDoughnut(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeGrid = DB::select('call ConsultaOEETrendsGrid(?,?,?,?,?,?,?,?)',array($caso,$idgroup,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeComponet = DB::select('call ConsultaOEEComponentes(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));

            $partId = DB::select('call ConsultaSelectpartId(?,?,?)',array($caso,$idmachine,$date));
            $lotId = DB::select('call ConsultaSelectlotId(?,?,?)',array($caso,$idmachine,$date));
            $turno = DB::select('call ConsultaSelectidShift(?,?,?,?)',array($caso,$idgroup,$idmachine,$date));

        return array ($oee,$oeepro,$oeeGrid,$oeeComponet,$partId,$lotId,$turno);
    }

    public function datospartid($idmachine,$caso,$date,$casoS,$partId)
    {    
            $lotId ='0';
            $idShift = 1; 
            $idgroup = auth()->user()->idgroup;
            $oee = DB::select('call ConsultaOEETrends(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeepro = DB::select('call ConsultaOEEDoughnut(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeGrid = DB::select('call ConsultaOEETrendsGrid(?,?,?,?,?,?,?,?)',array($caso,$idgroup,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeComponet = DB::select('call ConsultaOEEComponentes(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));

            $partId = DB::select('call ConsultaSelectpartId(?,?,?)',array($caso,$idmachine,$date));
            $lotId = DB::select('call ConsultaSelectlotId(?,?,?)',array($caso,$idmachine,$date));
            $turno = DB::select('call ConsultaSelectidShift(?,?,?,?)',array($caso,$idgroup,$idmachine,$date));

        return array ($oee,$oeepro,$oeeGrid,$oeeComponet,$partId,$lotId,$turno);
    }

    public function datoslotid($idmachine,$caso,$date,$casoS,$partId,$lotId)
    {    
            $idShift = 1; 
            $idgroup = auth()->user()->idgroup;
            $oee = DB::select('call ConsultaOEETrends(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeepro = DB::select('call ConsultaOEEDoughnut(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeGrid = DB::select('call ConsultaOEETrendsGrid(?,?,?,?,?,?,?,?)',array($caso,$idgroup,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeComponet = DB::select('call ConsultaOEEComponentes(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
 
            $partId = DB::select('call ConsultaSelectpartId(?,?,?)',array($caso,$idmachine,$date));
            $lotId = DB::select('call ConsultaSelectlotId(?,?,?)',array($caso,$idmachine,$date));
            $turno = DB::select('call ConsultaSelectidShift(?,?,?,?)',array($caso,$idgroup,$idmachine,$date));

        return array ($oee,$oeepro,$oeeGrid,$oeeComponet,$partId,$lotId,$turno);
    }
    public function datosidshift($idmachine,$caso,$date,$casoS,$partId,$lotId,$idShift)
    {    
            $idgroup = auth()->user()->idgroup;
            $oee = DB::select('call ConsultaOEETrends(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeepro = DB::select('call ConsultaOEEDoughnut(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeGrid = DB::select('call ConsultaOEETrendsGrid(?,?,?,?,?,?,?,?)',array($caso,$idgroup,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeComponet = DB::select('call ConsultaOEEComponentes(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
 
            $partId = DB::select('call ConsultaSelectpartId(?,?,?)',array($caso,$idmachine,$date));
            $lotId = DB::select('call ConsultaSelectlotId(?,?,?)',array($caso,$idmachine,$date));
            $turno = DB::select('call ConsultaSelectidShift(?,?,?,?)',array($caso,$idgroup,$idmachine,$date));

        return array ($oee,$oeepro,$oeeGrid,$oeeComponet,$partId,$lotId,$turno);
    }

    public function export($idmachine,$caso,$date,$casoS,$partId,$lotId,$idShift,$nomvar)
    {
        if($idShift=="all"){
            $idShift=1;
        }
        $idgroup = auth()->user()->idgroup;
        return (new OeeExport)->datos($idmachine,$caso,$date,$idgroup,$casoS,$partId,$lotId,$idShift,$nomvar)->download("ReporteOee$nomvar$date.xlsx");
    }

    public function andon($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $caso = "d";

        $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
        
       
        return view('graphics.andon')->with(compact('machines','date'));
    }
    public function datosandon($idmachine,$caso,$date,$casoS)
    {
        $partId = '0';
        $lotId ='0';
        $idShift = 1; 

        $oeepro = DB::select('call ConsultaOEEDoughnut(?,?,?,?,?,?,?)',array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
        
       
        return array ($oeepro);
    }
}
