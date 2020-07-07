<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeeComponentesSelectid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaOEEComponentesidselect");
        DB::unprepared("CREATE PROCEDURE `ConsultaOEEComponentesidselect`(IN `_caso` VARCHAR(3), IN `_machId` INT, IN `_inpid` varchar(45) )
        NO SQL
        IF (_caso = 'par') then    
                select 
                    min(date_format(capturedTime, '%Y-%m-%d'))date,  
                    cast( sum(goodParts)as decimal(10,2)) GoodParts,
                    cast( sum(totalPieces)as decimal(10,2)) TotalParts,
                    cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
                    cast( sum(runTime) as decimal(10,2)) RunningTime,
                    cast( sum(availableTime) as decimal(10,2)) AvailableTime,
                    cast( avg(ICT) as decimal(10,2)) ICT
                from oee where partId = _inpid and idmachine = _machId ;
                            
            ELSEIF (_caso='lot')then  
            
                select 
                    min(date_format(capturedTime, '%Y-%m-%d'))date,  
                    cast( sum(goodParts)as decimal(10,2)) GoodParts,
                    cast( sum(totalPieces)as decimal(10,2)) TotalParts,
                    cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
                    cast( sum(runTime) as decimal(10,2)) RunningTime,
                    cast( sum(availableTime) as decimal(10,2)) AvailableTime,
                    cast( avg(ICT) as decimal(10,2)) ICT
                from oee where lotId = _inpid and idmachine = _machId ;
        
                            
            ELSEIF (_caso='shi')then
                select 
                    min(date_format(capturedTime, '%Y-%m-%d'))date,  
                    cast( sum(goodParts)as decimal(10,2)) GoodParts,
                    cast( sum(totalPieces)as decimal(10,2)) TotalParts,
                    cast( sum(totalPieces) - sum(GoodParts) as decimal(10,2)) BadParts,
                    cast( sum(runTime) as decimal(10,2)) RunningTime,
                    cast( sum(availableTime) as decimal(10,2)) AvailableTime,
                    cast( avg(ICT) as decimal(10,2)) ICT
                from oee where idShift = _inpid and idmachine = _machId ;
                    
            END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaOEEComponentesidselect');
    }
}
