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
        Schema::create('laporan_hasil_gelars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->date('tanggal_laporan_gelar')->nullable();
            $table->string('nama_pimpinan_gelar')->nullable();
            $table->string('pangkat_pimpinan_gelar')->nullable();
            $table->string('jabatan_pimpinan_gelar')->nullable();
            $table->string('kesatuan_pimpinan_gelar')->nullable();
            $table->integer('id_penyidik_pemapar')->nullable();
            $table->integer('id_penyidik_pembuat')->nullable();
            $table->string('bukti')->nullable();
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
        Schema::dropIfExists('laporan_hasil_gelars');
        
    }
};
