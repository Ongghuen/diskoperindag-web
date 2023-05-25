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
        DB::unprepared('
            CREATE TRIGGER update_total_alat_after_delete
            AFTER DELETE ON bantuan_alat
            FOR EACH ROW
            BEGIN
                DECLARE alat_id INT;
                DECLARE kuantitas_deleted INT;
                
                SET alat_id = OLD.alat_id;
                SET kuantitas_deleted = OLD.kuantitas;
                
                UPDATE alat
                SET stok = stok - kuantitas_deleted
                WHERE id = alat_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_alat_after_delete');
    }
};
