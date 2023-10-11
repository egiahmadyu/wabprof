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
        Schema::table('laporan_hasil_gelars', function (Blueprint $table) {
            $table->string('pasal_dilanggar')->nullable();
            $table->string('kategori_pelanggaran')->nullable();
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('laporan_hasil_gelars', function (Blueprint $table) {
            //
        });
    }
};
