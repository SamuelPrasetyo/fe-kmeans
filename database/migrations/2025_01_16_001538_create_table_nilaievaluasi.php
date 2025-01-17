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
        Schema::create('nilaievaluasi', function (Blueprint $table) {
            $table->increments('idevaluasi');
            $table->string('semester');
            $table->string('tahunajar');
            $table->string('algoritma');
            $table->string('chi');
            $table->string('dbi');
            $table->string('ss');
            $table->string('parameter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilaievaluasi');
    }
};
