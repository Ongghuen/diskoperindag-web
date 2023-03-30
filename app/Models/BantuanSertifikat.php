<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanSertifikat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'bantuan_sertifikat';

    protected $fillable = ["bantuan_id", "sertifikat_id"];
}
