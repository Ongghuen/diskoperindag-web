<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersBantuan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'users_bantuan';

    protected $fillable = ["user_id", "bantuan_id"];
}
