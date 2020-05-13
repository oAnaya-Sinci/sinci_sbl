<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpCreateDatosTrends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS dbsistemalaravel.CrearDatosTrends;");
        DB::unprepared("CREATE PROCEDURE `CrearDatosTrends`(IN `fechaInicio` VARCHAR(19), IN `cuantos` int, IN `IdMaq` int)
        wholeblock:BEGIN
          #CALL `dbsistemalaravel`.`CrearDatosTrends`('2020-05-13 00:00', 1440, 1); #Ejemplo llamada manual
          declare str VARCHAR(255) default '';
          declare x INT default 0;
          declare dt datetime default fechaInicio; 
          
          SET x = 1;
        
          WHILE x <= cuantos DO
            
            insert into trends (id, idvariable ,date, value, highlimit, lowlimit ) VALUES (uuid(), IdMaq, dt, (sin(x*.01)*50) ,30 ,-30  );
            SET x = x + 1;
            SET DT = DATE_ADD(dt, INTERVAL 1 MINUTE);
          END WHILE;
        
          select str;
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS dbsistemalaravel.CrearDatosTrends;");
        DB::raw('DROP PROCEDURE `CrearDatosTrends`;');
        
    }
}
