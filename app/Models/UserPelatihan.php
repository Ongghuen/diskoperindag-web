<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPelatihan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_pelatihan'; //untuk menentukan tabel apa yang akan digunakan

    protected $fillable = ["user_id", "pelatihan_id"]; // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel user_pelatihan
}
