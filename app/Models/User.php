<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\Pelatihan;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    protected $fillable = [ //Berisikan kolom yang saja yang bisa diisi oleh pengguna dalam tabel user
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

    public $sortable = [ //berisikan kolom apa saja yang bisa dilakukan sorting secara ascending maupun descending
        'name',
        'email',
        'NIK',
        'kepala_keluarga',
        'phone',
    ];

    protected $hidden = [ 
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role() //relasi dari tabel user ke role secara many to one
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function bantuan() //relasi dari tabel user ke bantuan secara one to many
    {
        return $this->hasMany(Bantuan::class, 'user_id', 'id');
    }

    public function pelatihan() //relasi dari tabel user ke pelatihan secara many to many
    {
        return $this->belongsToMany(Pelatihan::class, 'user_pelatihan', 'user_id', 'pelatihan_id');
    }

    public function sertifikat() //relasi dari tabel user ke sertifikat secara many to many
    {
        return $this->belongsToMany(Sertifikat::class, 'user_sertifikat', 'user_id', 'sertifikat_id')
        ->withPivot(['no_sertifikat']);
    }

    public function berita() // relasi dari tabel user ke berita secara many to many
    {
        return $this->belongsToMany(Berita::class, 'berita_tersimpan', 'user_id', 'berita_id');
    }

    public function getUmurAttribute() //function untuk menginputkan value kedalam kolom umur secara otomatis
    {
        return $this->attributes['umur'] = Carbon::parse($this->attributes['tanggal_lahir'])->age;
    }

    public function routeNotificationForFcm() //function untuk get token fcm
    {
        return $this->fcm_token;
    }
}
