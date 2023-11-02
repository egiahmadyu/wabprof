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
        Schema::table('sidang_bandings', function (Blueprint $table) {
            $table->string('no_surat_lhs')->nullable();
            $table->date('tanggal_lhs')->nullable();
            $table->string('nomor_putusan')->nullable();
            $table->string('tanggal_putusan')->nullable();
        });

        Schema::table('sidang_peninjauans', function (Blueprint $table) {
            $table->string('no_surat_lhs')->nullable();
            $table->date('tanggal_lhs')->nullable();
            $table->string('nomor_putusan')->nullable();
            $table->string('tanggal_putusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sidang_bandings', function (Blueprint $table) {
            //
        });
    }
};
