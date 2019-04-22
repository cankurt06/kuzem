<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sertifikalar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifikalar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('bagis_id')->unsigned();
            $table->integer('user_bagis_id')->unsigned();
            $table->uuid('sertifika_uuid')->unique();
            $table->timestamps();
        });

        Schema::table('sertifikalar', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bagis_id')->references('id')->on('bagislar')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_bagis_id')->references('id')->on('user_bagis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sertifikalar');
    }
}
