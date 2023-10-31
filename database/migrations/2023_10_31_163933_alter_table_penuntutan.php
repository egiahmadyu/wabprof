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
            $table->string('permohonan_pendapat_dan_saran')->nullable();
            $table->date('tgl_permohonan_pendapat_dan_saran')->nullable();
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
