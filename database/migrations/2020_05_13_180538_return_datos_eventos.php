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
        DB::unprepared("CREATE PROCEDURE `ConsultaPareto`(IN `_caso` VARCHAR(1), IN `_machId` INT, IN `_inpdate` varchar(10) )
        NO SQL
    IF (_caso = 'd') then    
            /*Primero se obtiene el total de eventos contenidos en el periodo de tiempo y filtrado por maquina*/
            SET @Total = (SELECT count(descriptions) FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y-%m-%d' ) = date_format(_inpdate, '%Y-%m-%d' )  ); 
    
            /*luego se obtienen las frecuencias y se almacenan en una tabla temporal (filtrado por periodo de tiempo y por maquina)*/
            CREATE TEMPORARY TABLE IF NOT EXISTS eventosTemporal AS (
                SELECT 
                    descriptions, 
                    count(descriptions) Frecuencia 
                    FROM events 
                    WHERE idmachine = _machId AND date_format(startTime, '%Y-%m-%d' ) = date_format(_inpdate, '%Y-%m-%d' )
                    GROUP BY descriptions ORDER BY Frecuencia DESC);
            SET @CumulativeSum = 0;
            /*finalmente se obtienen los calculos derivados de las frecuencias*/
            SELECT 
                descriptions, 
                Frecuencia, 
                cast((Frecuencia / @Total)*100 AS DECIMAL(8,2))  Porc,
                @CumulativeSum := @CumulativeSum + Frecuencia Acumulado,
                cast((@CumulativeSum / @Total)*100 AS DECIMAL(8,2)) PorcentajeAcumulado
            FROM eventosTemporal;
            DROP TEMPORARY TABLE IF EXISTS eventosTemporal;
    ELSEIF (_caso='m')then  /*Obtener los promedios de la medicion cada media hora*/
            /*Primero se obtiene el total de eventos contenidos en el periodo de tiempo y filtrado por maquina*/
            SET @Total = (SELECT count(descriptions) FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'), '%Y-%m' )  ); 
            
            /*luego se obtienen las frecuencias y se almacenan en una tabla temporal (filtrado por periodo de tiempo y por maquina)*/
            CREATE TEMPORARY TABLE IF NOT EXISTS eventosTemporal AS (
                SELECT 
                    descriptions, 
                    count(descriptions) Frecuencia 
                    FROM events 
                    WHERE idmachine = _machId AND date_format(startTime, '%Y-%m' ) = date_format(concat( _inpdate ,'-01'), '%Y-%m' )
                    GROUP BY descriptions ORDER BY Frecuencia DESC);
            SET @CumulativeSum = 0;
            /*finalmente se obtienen los calculos derivados de las frecuencias*/
            SELECT 
                descriptions, 
                Frecuencia, 
                cast((Frecuencia / @Total)*100 AS DECIMAL(8,2))  Porc,
                @CumulativeSum := @CumulativeSum + Frecuencia Acumulado,
                cast((@CumulativeSum / @Total)*100 AS DECIMAL(8,2)) PorcentajeAcumulado
            FROM eventosTemporal;
            DROP TEMPORARY TABLE IF EXISTS eventosTemporal;
    ELSEIF (_caso='y')then
            /*Primero se obtiene el total de eventos contenidos en el periodo de tiempo y filtrado por maquina*/
            SET @Total = (SELECT count(descriptions) FROM EVENTS WHERE idmachine = _machId AND date_format(startTime, '%Y' ) = date_format(concat(_inpdate ,'-01-01'), '%Y' )  ); 
            
            /*luego se obtienen las frecuencias y se almacenan en una tabla temporal (filtrado por periodo de tiempo y por maquina)*/
            CREATE TEMPORARY TABLE IF NOT EXISTS eventosTemporal AS (
                SELECT 
                    descriptions, 
                    count(descriptions) Frecuencia 
                    FROM events 
                    WHERE idmachine = _machId AND date_format(startTime, '%Y' ) = date_format(concat(_inpdate ,'-01-01'), '%Y' )
                    GROUP BY descriptions ORDER BY Frecuencia DESC);
            SET @CumulativeSum = 0;
            /*finalmente se obtienen los calculos derivados de las frecuencias*/
            SELECT 
                descriptions, 
                Frecuencia, 
                cast((Frecuencia / @Total)*100 AS DECIMAL(8,2))  Porc,
                @CumulativeSum := @CumulativeSum + Frecuencia Acumulado,
                cast((@CumulativeSum / @Total)*100 AS DECIMAL(8,2)) PorcentajeAcumulado
            FROM eventosTemporal;
            DROP TEMPORARY TABLE IF EXISTS eventosTemporal;
    
    END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaPareto');
    }
}
