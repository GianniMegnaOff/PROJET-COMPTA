<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('Quote', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_projet');
            $table->dateTime('creation_date');
            $table->dateTime('payment_ate');
            $table->integer('payment_type');
            $table->text('deals');
            $table->text('comment');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('Quote');
    }
}
