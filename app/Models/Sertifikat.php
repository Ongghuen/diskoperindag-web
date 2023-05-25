<?php

namespace App\Models;

use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat'; //untuk menentukan tabel apa yang aka digunakan

    protected $fillable = [ // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel sertifikat
        'no_sertifikat',
        'nama',
        'tanggal_terbit',
        'kadaluarsa_penyelenggara',
        'keterangan',
        'user_id'
    ];

    public function user() //relasi dari tabel sertifikat ke user secara many to many
    {
        return $this->belongsToMany(User::class, 'user_sertifikat', 'sertifikat_id', 'user_id')
        ->withPivot(['no_sertifikat']);
    }
}
