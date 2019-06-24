<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleOnProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('RoleOnProject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_projet');
            $table->text('name', 70);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('RoleOnProject');
    }
}
