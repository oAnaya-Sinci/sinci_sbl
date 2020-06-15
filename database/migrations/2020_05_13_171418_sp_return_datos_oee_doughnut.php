<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosOeeDoughnut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaOEEDoughnut;");
        DB::unprepared("CREATE PROCEDURE `ConsultaOEEDoughnut`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
    IF (_caso = 'd') then    
                        
                        /*Segundo retornamos los promedios de ese dia*/
                        select 
                            min(date_format(capturedTime, '%Y-%m-%d'))date,  
                            cast((sum(runTime) / sum(availableTime))*100 as decimal(10,2) ) AvailabilityG,
                            cast( 100 - (sum(runTime) / sum(availableTime))*100 as decimal(10,2)) AvailabilityR,
                            cast( ((sum(totalPieces) * min(ICT))/sum(runTime))*100  as decimal(5,2)) as performanceG,
                            cast( 100- ((sum(totalPieces) * min(ICT))/sum(runTime))*100  as decimal(5,2)) as performanceR,
                            cast((sum(goodParts) / sum(totalPieces))*100 as decimal(10,2) ) qualityG,
                            cast( 100 - (sum(goodParts) / sum(totalPieces))*100 as decimal(10,2)) qualityR,
                            
                            cast(
                                ((sum(runTime)/Sum(availableTime)) * 
                                (sum(goodParts)/sum(totalPieces)) *
                                ((sum(totalPieces) * min(ICT))/sum(runTime)) )*100
                                as decimal(5,2)) as OEEG,
                            cast(100-
                                ((sum(runTime)/Sum(availableTime)) * 
                                (sum(goodParts)/sum(totalPieces)) *
                                ((sum(totalPieces) * min(ICT))/sum(runTime)) )*100
                                as decimal(5,2)) as OEER
                        from oee where date_format(capturedTime, '%Y-%m-%d') = _inpdate and idmachine = _machId ;
                    
                    ELSEIF (_caso='m')then  /*Obtener los promedios de la medicion cada media hora*/
                        
                        /*Segundo retornamos los promedios de todo el mes*/
                        select 
                            min(date_format(capturedTime, '%Y-%m'))date,  
                            cast( avg(availability)as decimal(5,2)) AvailabilityG,
                            cast( 100 - avg(availability) as decimal(5,2)) AvailabilityR,
                            cast( avg(performance)as decimal (5,2)) performanceG,
                            cast( 100 - avg(performance) as decimal(5,2)) performanceR,
                            cast( avg(quality) as decimal(5,2)) qualityG, 
                            cast( 100 - avg(quality) as decimal(5,2)) qualityR, 
                            cast( avg(oee) as decimal(5,2)) OEEG, 
                            cast( 100 - avg(oee) as decimal(5,2)) OEER
                        from oee where date_format(capturedTime, '%Y-%m') = date_format(concat( _inpdate ,'-01'),  '%Y-%m') and idmachine = _machId ;
                    
                    ELSEIF (_caso='y')then
                    
                    /*Segundo retornamos los promedios de todo el año como una subquery por que es por mes*/
                        /*Primero retornamos las tendencias, como los promedios mensuales del año*/
                    SELECT 
                        min(date) as date ,
                        cast( avg(availability) as decimal(5,2)) as AvailabilityG,
                        cast( 100 - avg(availability) as decimal(5,2)) AvailabilityR,
                        cast( avg(performance) as decimal(5,2))  as performanceG,
                        cast( 100 - avg(performance) as decimal(5,2)) performanceR,
                        cast( avg(quality) as decimal(5,2))  as qualityG,
                        cast( 100 - avg(quality) as decimal(5,2)) qualityR,
                        cast( avg(oee) as decimal(5,2))  OEEG, 
                        cast( 100 - avg(oee) as decimal(5,2)) OEER FROM 
                
                            (select 
                                min(date_format (capturedTime, '%Y-%m')) date,
                                cast( avg(availability) as decimal(5,2)) availability,
                                cast( avg(performance) as decimal(5,2)) performance,
                                cast( avg(quality) as decimal(5,2)) quality,
                                cast( avg(oee) as decimal(5,2)) oee
                            from oee 
                            where date_format(capturedTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') and idmachine = _machId
                            group by date_format(capturedTime, '%Y-%m')
                            order by date asc) 
                    AS Subquery;
            
                    
                    END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaOEEDoughnut');
    }
}
