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
            CREATE TRIGGER update_total_alat
            AFTER INSERT ON bantuan_alat
            FOR EACH ROW
            BEGIN
                UPDATE alat
                SET stok = (SELECT SUM(kuantitas) FROM bantuan_alat WHERE alat_id = NEW.alat_id)
                WHERE id = NEW.alat_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_total_alat');
    }
};
