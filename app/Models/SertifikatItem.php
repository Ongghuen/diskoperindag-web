<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sertifikat_item';

    protected $fillable = ["bantuan_id", "item_id"];
}
