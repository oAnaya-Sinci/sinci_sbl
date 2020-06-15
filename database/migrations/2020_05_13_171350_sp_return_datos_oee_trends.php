<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeeTrends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaOEETrends;");
        DB::unprepared("CREATE PROCEDURE `ConsultaOEETrends`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
    IF (_caso = 'd') then    
                /*Primero regresamos las tendencias del día*/
                select 
                    date_format(capturedTime, '%H:%i') date,
                    availability,
                    performance,
                    quality,
                    oee
                from oee
                where date_format(capturedTime, '%Y-%m-%d' ) = _inpdate and idmachine = _machId
                order by capturedTime asc;
                
            
            
            ELSEIF (_caso='m')then  /*Obtener los promedios de la medicion cada media hora*/
                /*Primero retornamos las tendencias, como los promedios diarios del mes*/
                select 
                    min(date_format (capturedTime, '%Y-%m-%d')) date,
                    cast( avg(availability) as decimal(5,2)) availability,
                    cast( avg(performance) as decimal(5,2)) performance,
                    cast( avg(quality) as decimal(5,2)) quality,
                    cast( avg(oee) as decimal(5,2)) oee
                from oee 
                where date_format(capturedTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and idmachine = _machId
                group by date_format(capturedTime, '%Y-%m-%d');
                
            
            ELSEIF (_caso='y')then
            /*Primero retornamos las tendencias, como los promedios mensuales del año*/
                select 
                    min(date_format (capturedTime, '%Y-%m')) date,
                    cast( avg(availability) as decimal(5,2)) availability,
                    cast( avg(performance) as decimal(5,2)) performance,
                    cast( avg(quality) as decimal(5,2)) quality,
                    cast( avg(oee) as decimal(5,2)) oee
                from oee 
                where date_format(capturedTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') and idmachine = _machid
                group by date_format(capturedTime, '%Y-%m')
                order by date asc;
            
            END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaOEETrends');
    }
}
