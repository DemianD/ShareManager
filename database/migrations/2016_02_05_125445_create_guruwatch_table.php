<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuruwatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guruwatches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('share_id');
            $table->string('title');
            $table->string('description');
            $table->string('link');
            $table->dateTime('pubDate');
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
        Schema::drop('guruwatches');
    }
}
