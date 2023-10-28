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
            $table->string('no_usulan_pembentukan_komisi')->nullable();
            $table->string('no_pembentukan_komisi')->nullable();
            $table->string('no_pendamping_divkum')->nullable();
            $table->string('no_panggilan_pelanggar')->nullable();
            $table->string('no_panggilan_pelanggar_satker')->nullable();
            $table->string('no_panggilan_saksi_anggota')->nullable();
            $table->string('no_panggilan_saksi_ahli_ssdm')->nullable();
            $table->string('no_surat_daftar_terlampir')->nullable();
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
