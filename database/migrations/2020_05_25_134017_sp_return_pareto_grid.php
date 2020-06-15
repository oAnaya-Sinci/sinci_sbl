<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnParetoGrid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaParetoGrid;");
        DB::unprepared("CREATE PROCEDURE `ConsultaParetoGrid`(IN `_caso` VARCHAR(1), IN `_groupId` INT, IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
        IF (_caso = 'd') then    
                
                        select 
                            events.id as idevent, events.idmachine,startTime,endTime,descriptions,justification,type,type_events.name as event,duration
                        from events
                        inner join type_events on type_events.id_type = events.type
                        where date_format(startTime, '%Y-%m-%d' ) = _inpdate and type_events.idgroup = _groupId and idmachine = _machId
                        order by startTime desc;
                        
                    ELSEIF (_caso='m')then  
                    
                        select 
                            events.id as idevent, events.idmachine,startTime,endTime,descriptions,justification,type,type_events.name as event,duration
                        from events
                        inner join type_events on type_events.id_type = events.type
                        where date_format(startTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and type_events.idgroup  = _groupId and idmachine = _machId
                        order by startTime desc;
                    
                    ELSEIF (_caso='y')then
                    /*Primero retornamos las tendencias, como los promedios mensuales del año*/
                    select 
                            events.id as idevent, events.idmachine,startTime,endTime,descriptions,justification,type,type_events.name as event,duration
                        from events
                        inner join type_events on type_events.id_type = events.type
                        where date_format(startTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'), '%Y') and type_events.idgroup = _groupId and idmachine = _machId
                        order by startTime desc;
                    
                END IF");
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaParetoGrid');
    }
}
