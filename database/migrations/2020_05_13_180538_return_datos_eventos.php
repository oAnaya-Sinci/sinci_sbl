<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReturnDatosEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaParetoHras;");
        DB::unprepared("CREATE PROCEDURE `ConsultaParetoHras`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
        IF (_caso = 'd') then    
            /*Primero se obtiene el total de eventos contenidos en el periodo de tiempo y filtrado por maquina*/
            SET @Total = (select sum(duration) FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y-%m-%d' ) = date_format(_inpdate, '%Y-%m-%d' ) AND type >= 1 );
			SET @TotalHras = (select sum(duration)/3600 FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y-%m-%d' ) = date_format(_inpdate, '%Y-%m-%d')AND type >= 1);  # /3600 para obtener hras

            /*luego se obtienen las duraciones Totales de los eventos y se almacenan en una tabla temporal (filtrado por periodo de tiempo y por maquina)*/
            CREATE TEMPORARY TABLE IF NOT EXISTS eventosTemporal AS (
                SELECT 
                    descriptions, 
                    sum(duration) Total 
                    FROM events 
                    WHERE idmachine = _machId AND date_format(startTime, '%Y-%m-%d' ) = date_format(_inpdate, '%Y-%m-%d' ) AND type >= 1
                    GROUP BY descriptions ORDER BY Total DESC);
                    SET @CumulativeSum = 0;
            
            CREATE TEMPORARY TABLE  table2 as 
				(SELECT 
					descriptions, 
					CAST(Total/3600 AS DECIMAL(8,2)) AS Total, 
					cast((Total / @Total)*100 AS DECIMAL(8,2)) as Porc,
					@CumulativeSum := @CumulativeSum + Total as Acumulado,
					cast((@CumulativeSum / @Total)*100 AS DECIMAL(8,2)) PorcentajeAcumulado
				FROM eventosTemporal
            );

            select 
				descriptions,
                Total,
                Porc,
                cast(Acumulado/3600 as decimal(18,2)) as Acumulado, 
                PorcentajeAcumulado from table2;
            
            DROP TEMPORARY TABLE IF EXISTS eventosTemporal;
            DROP TEMPORARY TABLE IF EXISTS table2;
    
        ELSEIF (_caso='m')then  /*Obtener los promedios del dia*/
			/*Primero se obtiene el total de segundos de duracion de los eventos en el periodo de tiempo y filtrado por maquina*/
            SET @Total = (select sum(duration) FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'),  '%Y-%m') AND type >= 1 );	      
			SET @TotalHras = (select sum(duration)/3600 FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'),  '%Y-%m') AND type >= 1 );  # /3600 para obtener hras

            /*luego se obtienen las duraciones Totales de los eventos y se almacenan en una tabla temporal (filtrado por periodo de tiempo y por maquina)*/
            CREATE TEMPORARY TABLE IF NOT EXISTS eventosTemporal AS (
                SELECT 
                    descriptions, 
                    sum(duration) Total 
                    FROM events 
                    WHERE idmachine = _machId AND date_format(startTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'),  '%Y-%m') AND type >= 1 
                    GROUP BY descriptions ORDER BY Total DESC);
			
            /*finalmente se obtienen los calculos derivados de las frecuencias*/ # HACER LOS CALCULOS AQUI Y COMPARAR
			SET @CumulativeSum = 0;
            CREATE TEMPORARY TABLE  table2 as 
				(SELECT 
					descriptions, 
					CAST(Total/3600 AS DECIMAL(8,2)) AS Total, 
					cast((Total / @Total)*100 AS DECIMAL(8,2)) as Porc,
					@CumulativeSum := @CumulativeSum + Total as Acumulado,
					cast((@CumulativeSum / @Total)*100 AS DECIMAL(8,2)) PorcentajeAcumulado
				FROM eventosTemporal
            );

            select 
				descriptions,
                Total,
                Porc,
                cast(Acumulado/3600 as decimal(18,2)) as Acumulado, 
                PorcentajeAcumulado from table2;
            
            DROP TEMPORARY TABLE IF EXISTS eventosTemporal;
            DROP TEMPORARY TABLE IF EXISTS table2;

        ELSEIF (_caso='y')then
		    /*Primero se obtiene el total de segundos de duracion de los eventos en el periodo de tiempo y filtrado por maquina*/
            SET @Total = (select sum(duration) FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') AND type >= 1);
			SET @TotalHras = (select sum(duration)/3600 FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') AND type >= 1 );  # /3600 para obtener hras
			
            /*luego se obtienen las duraciones Totales de los eventos y se almacenan en una tabla temporal (filtrado por periodo de tiempo y por maquina)*/
            CREATE TEMPORARY TABLE IF NOT EXISTS eventosTemporal AS (
                SELECT 
                    descriptions, 
                    sum(duration) Total 
                    FROM events 
                    WHERE idmachine = _machId AND date_format(startTime, '%Y' ) = date_format(concat( _inpdate ,'-01-01'),  '%Y') AND type >= 1 
                    GROUP BY descriptions ORDER BY Total DESC);
			#select * from eventosTemporal;
            /*finalmente se obtienen los calculos derivados de las frecuencias*/ # HACER LOS CALCULOS AQUI Y COMPARAR
			SET @CumulativeSum = 0;
            CREATE TEMPORARY TABLE  table2 as 
				(SELECT 
					descriptions, 
					CAST(Total/3600 AS DECIMAL(8,2)) AS Total, 
					cast((Total / @Total)*100 AS DECIMAL(8,2)) as Porc,
					@CumulativeSum := @CumulativeSum + Total as Acumulado,
					cast((@CumulativeSum / @Total)*100 AS DECIMAL(8,2)) PorcentajeAcumulado
				FROM eventosTemporal
            );
			
             select 
				descriptions,
                Total,
                Porc,
                cast(Acumulado/3600 as decimal(18,2)) as Acumulado, 
                PorcentajeAcumulado from table2;
            
            DROP TEMPORARY TABLE IF EXISTS eventosTemporal;
            DROP TEMPORARY TABLE IF EXISTS table2;
            
            
    
    END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaParetoHras');
    }
}
