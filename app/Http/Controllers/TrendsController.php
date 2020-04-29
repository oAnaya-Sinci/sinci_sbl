<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrendsController extends Controller
{
    public function __invoke(Request $request)
    {
        $anio=date('M');
        $oees=DB::table('trends as i')
        ->select(DB::raw('TIMESTAMP(i.capturedTime) as mes'),
        DB::raw('TIMESTAMP(i.capturedTime) as mes'),
        DB::raw('SUM(i.total) as total'))
        ->whereYear('i.capturedTime',$anio)
        ->groupBy(DB::raw('TIMESTAMP(i.capturedTime)'),DB::raw('TIMESTAMP(i.capturedTime)'))
        ->get();

        return ['oees'=>$trend,'mes'=>$anio];        

    }
}
