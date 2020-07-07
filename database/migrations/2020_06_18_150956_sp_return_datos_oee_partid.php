<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeePartid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaSelectpartId");
        DB::unprepared("CREATE PROCEDURE `ConsultaSelectpartId`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
        IF (_caso = 'd') then    
                select 
                    partId
                    from oee
                    where date_format(capturedTime, '%Y-%m-%d' ) = _inpdate and idmachine = _machId 
                    group by partId
                    order by partId asc;
                            
            ELSEIF (_caso='m')then  
            
                select 
                    partId
                    from oee
                    where date_format(capturedTime, '%Y-%m') = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and idmachine = _machId
                    group by partId
                    order by partId asc;
        
                            
            ELSEIF (_caso='y')then
                select 
                    partId
                    from oee
                    where date_format(capturedTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') and idmachine = _machId
                    group by partId
                    order by partId asc; 
                    
            END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaSelectpartId');
    }
}
