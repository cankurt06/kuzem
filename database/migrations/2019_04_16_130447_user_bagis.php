<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserBagis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bagis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bagis_no')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('bagis_id')->unsigned();
            $table->decimal('bagis_tutari',18,2);
            $table->tinyInteger('bagis_durumu')->default(0)->comment("0 ise ödeme bekliyor,1 ise ödendi.");
            $table->timestamps();
        });

        Schema::table('user_bagis', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bagis_id')->references('id')->on('bagislar')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_bagis');
    }
}
