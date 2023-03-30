<?php

namespace App\Models;


use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'item_pelatihan';

    protected $fillable = [
        'nama',
        'penyelenggara',
        'tanggal_pelaksanaan',
        'tempat',

    ];

    public function bantuan()
    {
        return $this->belongsToMany(Bantuan::class, 'pelatihan_item', 'item_id', 'bantuan_id');
    }
}
