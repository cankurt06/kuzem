<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bagislar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bagislar', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('bagis_adi');
            $table->string('bagis_slogan')->nullable();
            $table->text('bagis_icerik');
            $table->integer('bagis_turu')->unsigned();
            $table->decimal('bagis_tutar',18,2);
            $table->tinyInteger('slayt_goster')->default(0);
            $table->string('slayt_resmi')->nullable();
            $table->string('bagis_resmi')->nullable();
            $table->tinyInteger('onemli_bagis')->default(0);
            $table->tinyInteger('bagis_tamamlandi')->default(0);
            $table->string('slug')->unique();
            $table->timestamps();
        });
        Schema::table('bagislar', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bagis_turu')->references('id')->on('bagis_turleri')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bagislar');
    }
}
