<?php

namespace App\Models;

use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';

    protected $fillable = [
        'nama_item',
        'stok',
        'deskripsi'
    ];

    public function bantuan()
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_alat', 'alat_id', 'bantuan_id')
        ->withPivot(['kuantitas']);;
    }
}
