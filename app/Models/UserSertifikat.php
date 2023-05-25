<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSertifikat extends Model
{
    use HasFactory;

    public $timestamps = false; //untuk mematikan timestamp pada tabel seperti created_at dan updated_at

    protected $table = 'user_sertifikat'; //untuk menentukan tabel yang akan digunakan

    protected $fillable = ["user_id", "sertifikat_id", 'no_sertifikat']; // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel user_sertifikat
}
