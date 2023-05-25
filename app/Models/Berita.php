<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    protected $table = "berita"; // untuk menentukan tabel yang akan digunakan

    protected $fillable = [ // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel berita
        'image',
        'judul',
        'subjudul',
        'body',
        'deleted_at'
    ];

    use HasFactory, SoftDeletes; 
}
