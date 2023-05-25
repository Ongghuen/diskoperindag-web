<?php

namespace App\Models;

use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat'; // untuk menentukan tabel apa yang akan digunakan

    protected $fillable = [ // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel alat
        'nama_item',
        'stok',
        'deskripsi'
    ];

    public function bantuan() // relasi dari tabel alat ke bantuan secara many to many
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_alat', 'alat_id', 'bantuan_id')
        ->withPivot(['kuantitas']);;
    }
}
