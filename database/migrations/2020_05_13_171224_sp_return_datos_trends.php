<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpReturnDatosTrends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS ConsultaTrends;");
        DB::unprepared("CREATE PROCEDURE `ConsultaTrends`(IN `_caso` VARCHAR(1), IN `_varId` INT, IN `_inpdate` varchar(10) )
        NO SQL
    IF (_caso = 'd') then    
                SELECT 
                    date_format(date, '%H:%i') 'date', 
                    value, 
                    highLimit, 
                    lowLimit 
                FROM trends WHERE idvariable = _varId and date_format(date,  '%Y-%m-%d') = date_format(_inpdate,  '%Y-%m-%d')  order by date asc;
            
            ELSEIF (_caso='m')then  /*Obtener los promedios de la medicion cada media hora*/
                select     
                    concat(DATE_FORMAT (date, '%d %H:'), 
                    FLOOR(DATE_FORMAT(date,'%i')/30)*30,
                IF(DATE_FORMAT (date, '%i')<30, '0', '')) 'date',
                avg(value) value, 
                    highLimit, 
                    lowLimit 
                from trends 
                where date_format(date,  '%Y-%m') = date_format(concat( _inpdate ,'-01'),  '%Y-%m')
                group by 
                    concat(DATE_FORMAT (date, '%Y-%m-%d %H:'),
                    FLOOR(DATE_FORMAT(date,'%i')/30)*30,
                    IF(DATE_FORMAT (date, '%i')<30, '0', '')); 
            END IF");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS ConsultaTrends');
    }
}
