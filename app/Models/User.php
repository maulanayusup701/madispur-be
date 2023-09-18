<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
=======
use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
>>>>>>> 47018901d5c16bd2dc359f15d356cb66f302e841

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
<<<<<<< HEAD
        'name',
        'email',
        'password',
=======
        'email',
        'nama_lengkap',
        'username',
        'password',
        'no_handphone',
        'gender',
        'alamat_lengkap',
        'NIK',
        'nama_kampus/sekolah',
        'NIM',
        'NISN',
        'jurusan/prodi',
        'kelas/semester',
        'Keperluan',
        'status',
        'role_id',
        'login_terakhir',
>>>>>>> 47018901d5c16bd2dc359f15d356cb66f302e841
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
        'password' => 'hashed',
    ];
<<<<<<< HEAD
=======

    public function role(){
        return $this->belongsTo(Role::class);
    }
>>>>>>> 47018901d5c16bd2dc359f15d356cb66f302e841
}
