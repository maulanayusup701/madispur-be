<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'email',
        'nama_lengkap',
        'username',
        'password',
        'no_handphone',
        'gender',
        'alamat_lengkap',
        'NIK',
        'nama_kampus_atau_sekolah',
        'NIM',
        'NISN',
        'jurusan_atau_prodi',
        'kelas',
        'semester',
        'Keperluan',
        'status',
        'role_id',
        'login_terakhir',
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

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function getProfileUser(){
        return auth()->user();
    }

    public function getAllAccountSuperAdmin(){
        return User::where('role_id', '=', 1)->latest()->paginate(10);
    }

    public function getAllAccountAdmin(){
        return User::where('role_id', '=', 2)->latest()->paginate(10);
    }

    public function getAllAccountPeserta(){
        return User::where('role_id', '=', 3)->orWhere('role_id', '=', 4)->latest()->paginate(10);
    }

    public function findUser($id){
        return User::find($id);
    }
}
