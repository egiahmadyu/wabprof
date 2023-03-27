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
        Schema::create('bp3kepps', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->date('tanggal')->nullable();
            $table->string('nomor')->nullable();
            $table->string('nama')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('nrp')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kesatuan')->nullable();
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
        Schema::dropIfExists('bp3kepps');
    }
};
