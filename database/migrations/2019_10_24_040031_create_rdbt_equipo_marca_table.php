<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRdbtEquipoMarcaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdbt_equipo_marca', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rdbt_equipo_id')->unsigned();
            $table->foreign('rdbt_equipo_id')->references('id')->on('rdbt_equipos');
            $table->integer('rdbt_marca_id')->unsigned();
            $table->foreign('rdbt_marca_id')->references('id')->on('rdbt_marcas');
            $table->integer('rdbt_modelo_id')->unsigned();
            $table->foreign('rdbt_modelo_id')->references('id')->on('rdbt_modelos');
            $table->string('rdbtserie');
            $table->boolean('active')->default(1);
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            $table->integer('support_id')->unsigned()->nullable();
            $table->foreign('support_id')->references('id')->on('users');
            $table->date('rdbtFechaPrevencion')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('rdbt_equipo_marca');
    }
}
