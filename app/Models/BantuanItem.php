<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'bantuan_item';

    protected $fillable = ["bantuan_id", "item_id", "kuantitas"];
}
