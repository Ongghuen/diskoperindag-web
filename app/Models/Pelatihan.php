<?php

namespace App\Models;


use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'nama',
        'penyelenggara',
        'tanggal_pelaksanaan',
        'tempat',

    ];

    public function bantuan()
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_pelatihan', 'pelatihan_id', 'bantuan_id');
    }
}
