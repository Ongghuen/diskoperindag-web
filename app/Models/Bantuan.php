<?php

namespace App\Models;

use App\Models\User;
use App\Models\ItemBantuan;
use App\Models\ItemPelatihan;
use App\Models\ItemSertifikat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan'; // untuk menentukan tabel apa yang akan digunakan

    protected $fillable = [ // Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel bantuan
        'nama_bantuan',
        'jenis_usaha',
        'tahun_pemberian',
        'koordinator',
        'sumber_anggaran',
        'user_id'
    ];

    public function user() // relasi dari tabel bantuan ke user secara many to one
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function itemBantuan() //relasi dari tabel bantuan ke tabel alat secara many to many
    {
        return $this->belongsToMany(Alat::class, 'bantuan_alat', 'bantuan_id', 'alat_id')
            ->withPivot(['kuantitas']);
    }
}
