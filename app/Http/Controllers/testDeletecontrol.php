<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Machine;

class testDeletecontrol extends Controller
{
    public function show(){ // A ver con eloquent, matcheo una tabla con un modelo con su controlador y asi trae todos los datos en putiza.
        // Pero para mostrar el menu son ¿Que maquinas tienen OEE? ¿Que maquinas tienen variables?, ¿Que maquinas tienen alarmas?
        //select * from machines where id user sea igual al usuario actual. ¿De donde perras tomo el usuario actual
        
        //$machines = \DB::table('machines')->where('iduser', 2)->first();
        
        Machine::where('iduser',2)->first();
        
        $this->line('Display this on the screen');
        //$this->line($machines);
        

    }
}
