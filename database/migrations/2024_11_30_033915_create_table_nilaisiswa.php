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
            $table->string('semester');
            $table->integer('nis');
            $table->string('kelas');
            $table->string('nama_siswa');
            $table->integer('nagama');
            $table->integer('npkn');
            $table->integer('nbindo');
            $table->integer('nmatematika');
            $table->integer('nipa');
            $table->integer('nips');
            $table->integer('nbinggris');
            $table->integer('nsenibudaya');
            $table->integer('npjok');
            $table->integer('nprakarya');
            $table->integer('ntik');
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
