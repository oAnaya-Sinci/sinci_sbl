<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpCreateDatosOee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS CrearDatOSOEE;");
        DB::unprepared("CREATE  PROCEDURE `CrearDatosOEE`(IN `fechaInicio` VARCHAR(19), IN `cuantos` int, IN `IdMaq` int)
        wholeblock:BEGIN
          #CALL `dbsistemalaravel`.`CrearDatosOEE`('2020-05-13 00:00', 1440, 1); #Ejemplo llamada manual
          declare str VARCHAR(255) default '';
          declare x INT default 0;
          declare dt datetime default fechaInicio; 
          
          SET x = 1;
        
          WHILE x <= cuantos DO
            
            insert into oee 
            (	id,
                idmachine,
                capturedtime,
                availability,
                performance,
                quality,
                oee
            ) 
            
            VALUES ( 	uuid(),
                        IdMaq,
                        dt,
                        abs((sin(x*.01)*50)+1) ,
                        abs((sin(x*.01)*50)+2),
                        abs((sin(x*.01)*50)+3),
                        abs((sin(x*.01)*50)+4) 
                    );
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
        DB::unprepared('DROP PROCEDURE IF EXISTS CrearDatosOee');
    }
}
