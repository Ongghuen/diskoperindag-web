<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Berita extends Model
{
    protected $table = "berita";

    protected $fillable = [
        'image',
        'judul',
        'subjudul',
        'body',
        'deleted_at'
    ];

    use HasFactory, SoftDeletes;
}
