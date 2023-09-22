<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'route',
        'icon',
        'deskripsi',
    ];
    
    public function permission(){
        return $this->hasMany(Permission::class);
    }

    public function getAllMenu(){
        return Menu::all();
    }

    public function getMenuSearch($search){
        return Menu::where('nama', 'like', '%'.$search.'%')->get();
    }
}