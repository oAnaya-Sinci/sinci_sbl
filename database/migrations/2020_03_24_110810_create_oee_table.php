<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oee', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('capturedTime');
            $table->float('oee');
            $table->float('availability');
            $table->integer('runnigTime');
            $table->string('availableTime', 45);
            $table->float('performance');
            $table->integer('ict');
            $table->integer('totalPieces');
            $table->integer('runTime');
            $table->string('oeeCol');
            $table->float('quality');
            $table->integer('goodParts');
            $table->string('lotId', 45);
            $table->string('partId', 45);
            $table->integer('idShift');
            $table->timestamps();

         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oee');
    }
}
