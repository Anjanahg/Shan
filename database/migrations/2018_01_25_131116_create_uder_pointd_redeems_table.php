<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUderPointdRedeemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uder_pointd_redeems', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('uId');
            $table->integer('totalPoints');
            $table->integer('remaining');
            $table->integer('redeem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uder_pointd_redeems');
    }
}
