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
        DB::unprepared("CREATE PROCEDURE `CrearDatosTrends`()
        wholeblock:BEGIN
          declare str VARCHAR(255) default '';
          declare x INT default 0;
          declare dt datetime default '2020-05-01 00:00'; 
          
          SET x = 1;
        
          WHILE x <= 1440 DO
            
            insert into trends (id, idvariable ,date, value, highlimit, lowlimit ) VALUES (uuid(), 2, dt, (sin(x*.01)*50) ,30 ,-30  );
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
        DB::unprepared('DROP PROCEDURE IF EXISTS CrearDatosTrends');

    }
}
