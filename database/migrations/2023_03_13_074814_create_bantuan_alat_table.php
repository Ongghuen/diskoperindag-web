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
        Schema::create('bantuan_alat', function (Blueprint $table) {
            $table->unsignedBigInteger('bantuan_id');
            $table->foreign('bantuan_id')->references('id')->on('bantuan')->onDelete('restrict');
            $table->unsignedBigInteger('alat_id');
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('restrict');
            $table->integer('kuantitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan_alat');
    }
};
