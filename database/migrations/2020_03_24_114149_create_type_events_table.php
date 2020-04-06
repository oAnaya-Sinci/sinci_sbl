<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->unique();
            $table->integer('idmachine')->unsigned();
            $table->integer('id_faild');
            $table->string('description', 45);
            $table->integer('severity');
            $table->boolean('condicion')->default(1);
            $table->timestamps();

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
        Schema::dropIfExists('type_events');
    }
}
