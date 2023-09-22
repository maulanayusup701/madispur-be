<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'jumlah_user',
        'created_date',
        'created_by',
        'modified_date',
        'modified_by',
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
