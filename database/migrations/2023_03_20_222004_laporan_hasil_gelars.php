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
            $table->string('nama_pemapar')->nullable();
            $table->string('pangkat_pemapar')->nullable();
            $table->string('jabatan_pemapar')->nullable();
            $table->string('kesatuan_pemapar')->nullable();
            $table->string('nrp_pembuat')->nullable();
            $table->string('nama_pembuat')->nullable();
            $table->string('pangkat_pembuat')->nullable();
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
