<?php

namespace App\Models;

use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'item_sertifikat';

    protected $fillable = [
        'no_sertifikat',
        'nama',
        'tanggal_terbit',
        'kadaluarsa_penyelenggara',
        'keterangan',
    ];

    public function bantuan()
    {
        return $this->belongsToMany(Bantuan::class, 'sertifikat_item', 'item_id', 'bantuan_id');
    }
}
