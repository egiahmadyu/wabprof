<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('undangan_gelars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->string('nomor_gelar')->nullable();
            $table->date('tanggal_gelar')->nullable();
            $table->string('tempat_gelar')->nullable();
            $table->time('jam_gelar')->nullable();
            $table->integer('id_penyidik')->nullable();
            $table->string('nomor_handphone')->nullable();
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
        Schema::dropIfExists('undangan_gelars');
        
    }
};
