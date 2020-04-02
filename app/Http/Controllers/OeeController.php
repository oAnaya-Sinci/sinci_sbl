<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OeeController extends Controller
{
    public function __invoke(Request $request)
    {
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
