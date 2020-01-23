<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRdbtPreventivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdbt_preventivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipo_marca_id')->unsigned();
            $table->foreign('equipo_marca_id')->references('id')->on('rdbt_equipo_marca');
            $table->integer('support_id')->unsigned()->nullable();
            $table->foreign('support_id')->references('id')->on('users');
            $table->string('rdbtDetalle');
            $table->string('rdbtRecomendacion');
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
        Schema::dropIfExists('rdbt_preventivos');
    }
}
