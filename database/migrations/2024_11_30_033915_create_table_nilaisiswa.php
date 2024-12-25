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
            $table->string('tahunajar');
            $table->string('nis');
            $table->string('kelas');
            $table->string('nama_siswa');
            $table->string('nagama');
            $table->string('npkn');
            $table->string('nbindo');
            $table->string('nmatematika');
            $table->string('nipa');
            $table->string('nips');
            $table->string('nbinggris');
            $table->string('nsenibudaya');
            $table->string('npjok');
            $table->string('nprakarya');
            $table->string('ntik');
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
