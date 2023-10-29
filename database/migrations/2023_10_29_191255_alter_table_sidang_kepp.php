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
        Schema::table('sidang_kepps', function (Blueprint $table) {
            $table->integer('keputusan_etik')->default(0);
            $table->integer('keputusan_administratif')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sidang_kepps', function (Blueprint $table) {
            //
        });
    }
};
