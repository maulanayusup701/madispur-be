<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct(){
        $this->search = new Menu();
    }

    public function MenuSearch(Request $request){

        $search = request('search');
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  $this->search->getMenuSearch($search),
        ]);
    }
}
