<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanPelatihan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'bantuan_pelatihan';

    protected $fillable = ["bantuan_id", "pelatihan_id"];
}
