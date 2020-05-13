<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS CrearDatosEventos;");
        DB::unprepared("CREATE PROCEDURE `CrearDatosEventos`(IN `fechaInicio` VARCHAR(19), IN `cuantos` int, IN `IdMaq` int, IN `tipo` int)
        wholeblock:BEGIN
        /*Este SP conjuga aleatoriamente palabras para formar eventos con descripciones de la forma: Peso-High, Temperatura-Low etc, de duracion aleatoria congruente (duracion positiva)
        Se recuerda que el tipo evento los estamos dejando todos en 1, Es un filtrado: con 1 entran en pareto con cualquier otro no.
        Recibe datetime entrada, cantidad de eventos a generar (c2 min), idmaquina (debe existir en catalogo), tipo evento ( 1 entra en pareto), 
        Ejemplo para llamar la funcion. 
        #CALL `dbsistemalaravel`.`CrearDatosEventos2` ( '2020-01-01 00:00', 100, 1, 1 );
        */
          declare x INT default 0;
          SET @fecha =  fechaInicio;
          set @fecha2 = fechainicio;
          
          /*Crear tablas temporales auxiliar*/
          CREATE TEMPORARY TABLE AlarmValues(
               id INT NOT NULL AUTO_INCREMENT,
               valores VARCHAR(20) NOT NULL,
               PRIMARY KEY ( id )
            );
        INSERT INTO AlarmValues values (1,'Low'), (2,'high');
        
        CREATE TEMPORARY TABLE Variables (valores VARCHAR(50));
        INSERT INTO Variables values 
            ('Ritmo'),
            ('Tiempo de Operacion'),
            ('Consumo de energía'),
            ('Presion'),
            ('Nivel'),
            ('Peso'),
            ('Temperatura'),
            ('Temperatura de bulbo húmedo'),
            ('Temperatura de bulbo seco ');
            
          
          /*INICIO DEL WHILE*/
          WHILE x <= (cuantos) DO
            
            insert into events 
                (	id,
                    idmachine,
                    startTime,
                    endTime,
                    type,
                    descriptions,
                    duration
                ) 
            
                values 
                (
                    uuid(),
                    idMaq,
                     @fecha, 
                     @fecha2, 
                    tipo,
                    ( SELECT concat( (select valores from Variables order by rand() limit 1 ),'-', (select valores from alarmValues order by rand() limit 1 ))  ),
                    (select time_to_sec( timediff( @fecha2, @fecha)    ))
                    
                );
            
            SET x = x + 1;
            
            set @fecha = date_add(@fecha, INTERVAL 3 minute);
            set @fecha2 = date_add(@fecha, INTERVAL FLOOR(RAND() * 10)+1 MINUTE); /*Aleatorio entre 1 y 10. La duracion del nuevo evento nunca sera negativa*/
            
          END WHILE;
        
        drop temporary table alarmValues;
        drop temporary table variables;
        
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS CrearDatosEventos');
    }
}