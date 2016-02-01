<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('share_id');
            $table->integer('user_id');

            $table->double('boughtFor', '6', 2);
            $table->double('amount', '6', 2);

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
        Schema::drop('share_user');
    }
}
