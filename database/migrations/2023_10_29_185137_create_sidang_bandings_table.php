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
        Schema::create('sidang_bandings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->date('tanggal_permohonan_sidang_banding')->nullable();
            $table->date('tgl_sidang')->nullable();
            $table->string('tempat_sidang')->nullable();
            $table->string('pakaian_sidang')->nullable();
            $table->string('jam_sidang')->nullable();
            $table->string('kehadiran')->nullable();
            $table->string('putusan_sidang')->nullable();
            $table->string('keputusan_terbukti')->nullable();
            $table->string('keputusan_sidang')->nullable();
            $table->integer('keputusan_etik')->default(0);
            $table->integer('keputusan_administratif')->default(0);
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
        Schema::dropIfExists('sidang_bandings');
    }
};
