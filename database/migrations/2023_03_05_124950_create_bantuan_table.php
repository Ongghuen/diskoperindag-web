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
        Schema::create('bantuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bantuan', 100);
            $table->string('koordinator', 100)->default('Belum ada');
            $table->string('sumber_anggaran', 50)->default('Belum ada');
            $table->date('tahun_pemberian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan');
    }
};
