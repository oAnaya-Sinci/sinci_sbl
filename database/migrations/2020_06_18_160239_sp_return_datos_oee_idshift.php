<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeeIdshift extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaSelectidShift");
        DB::unprepared("CREATE PROCEDURE `ConsultaSelectidShift`(IN `_caso` VARCHAR(1), IN `_groupId` INT, IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
        IF (_caso = 'd') then    
                select 
                    idShift,
                    shifts.name as turno
                    from oee
                    inner join shifts on shifts.id = oee.idShift
                    where date_format(capturedTime, '%Y-%m-%d' ) = _inpdate and shifts.idgroup = _groupId and idmachine = _machId 
                    group by idShift
                    order by idShift asc;
                            
            ELSEIF (_caso='m')then  
            
                select 
                    idShift,
                    shifts.name as turno
                    from oee
                    inner join shifts on shifts.id = oee.idShift
                    where date_format(capturedTime, '%Y-%m') = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and shifts.idgroup = _groupId and idmachine = _machId
                    group by idShift
                    order by idShift asc;
        
                            
            ELSEIF (_caso='y')then
                select 
                    idShift,
                    shifts.name as turno
                    from oee
                    inner join shifts on shifts.id = oee.idShift
                    where date_format(capturedTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') and shifts.idgroup = _groupId and idmachine = _machId
                    group by idShift
                    order by idShift asc; 
                    
            END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaSelectidShift');
    }
}
