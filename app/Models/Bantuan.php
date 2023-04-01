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

    protected $table = 'bantuan';

    protected $fillable = [
        'nama_bantuan',
        'jenis_usaha',
        'tahun_pemberian',
        'koordinator',
        'sumber_anggaran',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function itemBantuan()
    {
        return $this->belongsToMany(Alat::class, 'bantuan_alat', 'bantuan_id', 'alat_id')
            ->withPivot(['kuantitas']);
    }
}
