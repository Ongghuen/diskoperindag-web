<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanAlat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'bantuan_alat';

    protected $fillable = ["bantuan_id", "alat_id", "kuantitas"];
}
