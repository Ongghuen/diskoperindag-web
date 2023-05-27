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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('fcm_token')->nullable();
            $table->string('NIK', 16);
            $table->string('alamat', 100);
            $table->string('phone', 15);
            $table->enum('gender', ['L', 'P']);
            $table->boolean('kepala_keluarga')->default(false);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur');
            $table->string('jenis_usaha', 50)->nullable()->default('Tidak Ada');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
