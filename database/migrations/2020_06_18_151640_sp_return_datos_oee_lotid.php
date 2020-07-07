<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeeLotid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaSelectlotId");
        DB::unprepared("CREATE PROCEDURE `ConsultaSelectlotId`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
        IF (_caso = 'd') then    
                select 
                    lotId
                    from oee
                    where date_format(capturedTime, '%Y-%m-%d' ) = _inpdate and idmachine = _machId 
                    group by lotId
                    order by lotId asc;
                            
            ELSEIF (_caso='m')then  
            
                select 
                    lotId
                    from oee
                    where date_format(capturedTime, '%Y-%m') = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and idmachine = _machId
                    group by lotId
                    order by lotId asc;
        
                            
            ELSEIF (_caso='y')then
                select 
                    lotId
                    from oee
                    where date_format(capturedTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') and idmachine = _machId
                    group by lotId
                    order by lotId asc; 
                    
            END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaSelectlotId');
    }
}
