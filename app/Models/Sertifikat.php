<?php

namespace App\Models;

use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikat';

    protected $fillable = [
        'no_sertifikat',
        'nama',
        'tanggal_terbit',
        'kadaluarsa_penyelenggara',
        'keterangan',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_sertifikat', 'sertifikat_id', 'user_id')
        ->withPivot(['no_sertifikat']);
    }
}
