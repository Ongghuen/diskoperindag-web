<?php

namespace App\Models;

use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemBantuan extends Model
{
    use HasFactory;

    protected $table = 'item_bantuan';

    protected $fillable = [
        'nama_item',
        'stok'
    ];

    public function bantuan()
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_item', 'item_id', 'bantuan_id');
    }
}
