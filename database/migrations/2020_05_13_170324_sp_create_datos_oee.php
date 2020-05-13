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
        DB::unprepared("CREATE  PROCEDURE `CrearDatosOEE`()
        wholeblock:BEGIN
          declare str VARCHAR(255) default '';
          declare x INT default 0;
          declare dt datetime default '2020-05-01 00:00'; 
          
          SET x = 1;
        
          WHILE x <= 70560 DO
            
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
                        1,
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
