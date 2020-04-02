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
            $table->datetime('capturedTime')->nullable();
            $table->float('oee')->nullable();
            $table->float('availability')->nullable();
            $table->integer('runnigTime')->nullable();
            $table->string('availableTime', 45)->nullable();
            $table->float('performance')->nullable();
            $table->integer('ict')->nullable();
            $table->integer('totalPieces')->nullable();
            $table->integer('runTime')->nullable();
            $table->string('oeeCol')->nullable();
            $table->float('quality')->nullable();
            $table->integer('goodParts')->nullable();
            $table->string('lotId', 45)->nullable();
            $table->string('partId', 45)->nullable();
            $table->integer('idShift')->nullable();
            $table->decimal('total', 11, 2)->nullable();
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
