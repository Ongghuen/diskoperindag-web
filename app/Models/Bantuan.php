<?php

namespace App\Models;

use App\Models\User;
use App\Models\ItemBantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan';

    protected $fillable = [
        'name_bantuan',
        'jenis_usaha',
        'tahun_pemberian'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function itemBantuan()
    {
        return $this->belongsToMany(ItemBantuan::class, 'bantuan_item', 'bantuan_id', 'item_id')
        ->withPivot(['kuantitas']);
    }
}
