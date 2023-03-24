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
        Schema::create('limpah_poldas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->bigInteger('polda_id');
            $table->date('tanggal_limpah');
            $table->string('nomor_limpah')->default('123');
            $table->text('alamat_polda')->nullable();
            $table->bigInteger('created_by');
            $table->string('nomor_klarifikasi')->default('123');
            $table->date('tanggal_klarifikasi')->nullable();
            $table->string('perihal_klarifikasi')->default('123');
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
        Schema::dropIfExists('limpah_poldas');
    }
};