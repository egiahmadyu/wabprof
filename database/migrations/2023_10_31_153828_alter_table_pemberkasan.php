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
        Schema::table('pemberkasans', function (Blueprint $table) {
            $table->date('tgl_sidang')->nullable()->change();
            $table->string('tempat_sidang')->nullable()->change();
            $table->string('pakaian_sidang')->nullable()->change();
            $table->string('jam_sidang')->nullable()->change();
            $table->string('no_nota_dinas_penyerahan')->nullable()->change();
            $table->date('tgl_nota_dinas_penyerahan')->nullable()->change();
            $table->string('no_nota_dinas_penyerahan_bp3kepp')->nullable();
            $table->date('tgl_nota_dinas_penyerahan_bp3kepp')->nullable();
            $table->string('no_nota_dinas_penyerahan_hasil_perbaikan')->nullable();
            $table->date('tgl_nota_dinas_penyerahan_hasil_perbaikan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemberkasans', function (Blueprint $table) {
            //
        });
    }
};
