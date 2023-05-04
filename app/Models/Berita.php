<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = "berita";


    protected $fillable = [
        'image',
        'judul',
        'subjudul',
        'body',
    ];

    use HasFactory;
}
