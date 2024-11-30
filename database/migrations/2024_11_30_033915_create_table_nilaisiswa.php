<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilaisiswa', function (Blueprint $table) {
            $table->increments('idnilai');
            $table->integer('nis');
            $table->string('nama_siswa');
            $table->string('nama_mapel');
            $table->float('nilai');
            $table->integer('link_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilaisiswa');
    }
};
