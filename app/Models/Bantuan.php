<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bantuan extends Model
{
    use HasFactory;

    protected $table = 'bantuan';

    protected $fillable = [
        'name',
        'category'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_bantuan', 'bantuan_id', 'user_id');
    }
}
