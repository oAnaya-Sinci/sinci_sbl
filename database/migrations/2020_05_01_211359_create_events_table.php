<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('idmachine')->unsigned();
            $table->datetime('startTime');
            $table->datetime('endTime');
            $table->integer('type');
            $table->string('descriptions', 45);
            $table->string('justification', 45)->nullable();
            $table->integer('duration');
            $table->integer('id_plc')->nullable();
            //$table->timestamps();

            $table->foreign('idmachine')->references('id')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
