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
        Schema::create('isi_bantuan', function (Blueprint $table) {
            $table->unsignedBigInteger('bantuan_id');
            $table->foreign('bantuan_id')->references('id')->on('bantuan')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('item_bantuan')->onDelete('cascade');
            $table->integer('kuantitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_bantuan');
    }
};
