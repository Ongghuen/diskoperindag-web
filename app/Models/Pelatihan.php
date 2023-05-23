<?php

namespace App\Models;


use App\Models\Bantuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelatihan extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'nama',
        'penyelenggara',
        'tanggal_pelaksanaan',
        'tempat',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_pelatihan', 'pelatihan_id', 'user_id');
    }
}
