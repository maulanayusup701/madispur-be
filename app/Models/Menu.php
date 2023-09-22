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
        return Menu::paginate(10);
    }

    public function getMenuSearch($search){
        return $search == null ? Menu::all()->paginate(10):Menu::where('nama', 'like', '%'.$search.'%')->paginate(10);
    }
}