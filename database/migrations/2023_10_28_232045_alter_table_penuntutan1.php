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
        Schema::table('penuntutans', function (Blueprint $table) {
            $table->date('tanggal_pembentukan_komisi')->nullable();
            $table->date('tanggal_pendamping_divkum')->nullable();
            $table->date('tanggal_panggilan_pelanggar')->nullable();
            $table->date('tanggal_panggilan_pelanggan_satker')->nullable();
            $table->date('tanggal_panggilan_saksi_anggota')->nullable();
            $table->date('tanggal_panggilan_saksi_ssdm')->nullable();
            $table->date('tanggal_surat_daftar_nama_terlampir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penuntutans', function (Blueprint $table) {
            //
        });
    }
};
