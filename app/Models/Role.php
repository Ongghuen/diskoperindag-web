<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public function user() //relasi dari tabel role ke user secara one to many
    {
        return $this->hasOne(User::class);
    }
}
