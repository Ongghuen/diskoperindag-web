<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanAlat extends Model
{
    use HasFactory;

    public $timestamps = false; //untuk mematikan timestamp seperti created_at dan updated_at pada tabel bantuan

    protected $table = 'bantuan_alat'; //untuk menentukan tabel apa yang akan digunakan

    protected $fillable = ["bantuan_id", "alat_id", "kuantitas"]; // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel bantuan_alat
}
