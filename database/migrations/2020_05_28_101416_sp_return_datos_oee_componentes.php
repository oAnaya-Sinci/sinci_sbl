<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeeComponentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaOEEComponentes;");
        DB::unprepared("CREATE PROCEDURE `ConsultaOEEComponentes`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
    IF (_caso = 'd') then    
            select 
                min(date_format(capturedTime, '%Y-%m-%d'))date,  
                cast( sum(goodParts)as decimal(10,2)) GoodParts,
                cast( sum(totalPieces)as decimal(10,2)) TotalParts,
                cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
                cast( sum(runTime) as decimal(10,2)) RunningTime,
                cast( sum(availableTime) as decimal(10,2)) AvailableTime,
                cast( avg(ICT) as decimal(10,2)) ICT
            from oee where date_format(capturedTime, '%Y-%m-%d') = _inpdate and idmachine = _machId ;
                        
        ELSEIF (_caso='m')then  /*Obtener los promedios de la medicion cada media hora*/
            select 
                min(date_format(capturedTime, '%Y-%m-%d'))date,  
                cast( sum(goodParts)as decimal(10,2)) GoodParts,
                cast( sum(totalPieces)as decimal(10,2)) TotalParts,
                cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
                cast( sum(runTime) as decimal(10,2)) RunningTime,
                cast( sum(availableTime) as decimal(10,2)) AvailableTime,
                cast( avg(ICT) as decimal(10,2)) ICT
            from oee where date_format(capturedTime, '%Y-%m') = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and idmachine = _machId ;
                        
        ELSEIF (_caso='y')then
            select 
                min(date_format(capturedTime, '%Y-%m-%d'))date,  
                cast( sum(goodParts)as decimal(10,2)) GoodParts,
                cast( sum(totalPieces)as decimal(10,2)) TotalParts,
                cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
                cast( sum(runTime) as decimal(10,2)) RunningTime,
                cast( sum(availableTime) as decimal(10,2)) AvailableTime,
                cast( avg(ICT) as decimal(10,2)) ICT
            from oee  where date_format(capturedTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') and idmachine = _machId;
                
                        
        END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaOEEComponentes;");
    }
}
