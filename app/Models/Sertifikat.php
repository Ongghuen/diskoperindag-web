<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
