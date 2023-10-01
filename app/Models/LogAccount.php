<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAccount extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'ip_address',
        'aktivitas',
        'status',
        'browser',
        'os',
        'device',
        'tanggal'
    ];

    public function getAllLogAccount(){
        return LogAccount::paginate(10);
    }
}
