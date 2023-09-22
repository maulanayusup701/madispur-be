<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct(){
        $this->search = new Role();
    }

    public function RoleSearch(Request $request){

        $search = request('search');
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  $this->search->getRoleSearch($search),
        ]);
    }
}
