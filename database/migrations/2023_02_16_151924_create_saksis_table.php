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
        Schema::create('saksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_pelanggar_id');
            $table->string('nrp')->nullable();
            $table->string('nama')->nullable();
            $table->Integer('id_pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kesatuan')->nullable();
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
        Schema::dropIfExists('saksis');
    }
};