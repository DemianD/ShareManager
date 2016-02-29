<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('share_id');
            $table->double('price', '6', 2);
            $table->dateTime('lastTradeDate');
            $table->timestamps();

            $table->foreign('share_id')
                ->references('id')->on('shares')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('share_prices');
    }
}
