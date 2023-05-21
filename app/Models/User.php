<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'NIK',
        'kepala_keluarga',
        'gender',
        'alamat',
        'phone',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
    ];

    public $sortable = [
        'name',
        'email',
        'NIK',
        'kepala_keluarga',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function bantuan()
    {
        return $this->hasMany(Bantuan::class, 'user_id', 'id');
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class, 'user_id', 'id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'user_id', 'id');
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'user_id', 'id');
    }

    public function berita()
    {
        return $this->belongsToMany(Berita::class, 'berita_tersimpan', 'user_id', 'berita_id');
    }

    public function getUmurAttribute()
    {
        return $this->attributes['umur'] = Carbon::parse($this->attributes['tanggal_lahir'])->age;
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }
}
