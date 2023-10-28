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
        Schema::create('pemberkasans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->string('no_nota_dinas_administrasi');
            $table->date('tgl_nota_dinas_administrasi');
            $table->date('tgl_sidang');
            $table->string('tempat_sidang');
            $table->string('pakaian_sidang');
            $table->string('jam_sidang');
            $table->string('no_nota_dinas_penyerahan');
            $table->date('tgl_nota_dinas_penyerahan');
            $table->string('no_bp3kepp');
            $table->date('tgl_bp3kepp');
            $table->string('no_nota_dinas_perbaikan')->nullable();
            $table->date('tgl_nota_dinas_perbaikan')->nullable();
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
        Schema::dropIfExists('pemberkasans');
    }
};
