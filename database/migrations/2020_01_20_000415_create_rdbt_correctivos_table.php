<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRdbtCorrectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdbt_correctivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rdbt_asignacion_id')->unsigned();
            $table->foreign('rdbt_asignacion_id')->references('id')->on('rdbt_asignacions');
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
        Schema::dropIfExists('rdbt_correctivos');
    }
}
