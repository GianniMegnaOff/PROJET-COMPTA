<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('Customer', function (Blueprint $table) {

            $table->increments('id');
            $table->string('last_name', 70);
            $table->string('first_name', 70);
            $table->string('mail', 255);
            $table->string('adress', 255);
            $table->integer('zip_code');
            $table->integer('siret');
            $table->string('company_name', 255);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Customer');
    }
}
