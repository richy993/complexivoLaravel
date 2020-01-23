<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRdbtAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('rdbt_asignacions', function (Blueprint $table) {
       $table->increments('id');

       $table->string('title');
       $table->string('description');            
       $table->string('severity', 1);

       $table->boolean('active')->default(1);
       $table->integer('equipo_marca_id')->unsigned();
       $table->foreign('equipo_marca_id')->references('id')->on('rdbt_equipo_marca');
       $table->integer('client_id')->unsigned();
       $table->foreign('client_id')->references('id')->on('users');

       $table->integer('support_id')->unsigned()->nullable();
       $table->foreign('support_id')->references('id')->on('users');

      
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
      Schema::dropIfExists('rdbt_asignacions');
    }
  }
