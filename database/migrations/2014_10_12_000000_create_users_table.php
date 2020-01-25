<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rdbtcedula');
            $table->string('rdbtnombre');
            $table->string('rdbtapellido');
            $table->string('rdbttelefono');
            $table->string('rdbtdirreccion');
            $table->string('rdbtrol');// 0:Admin| 1: support| 2: clients
            $table->string('email')->unique();
            $table->string('password');
            //$table->text('session_id');
            
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
