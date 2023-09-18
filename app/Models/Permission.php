<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'menu_id',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
