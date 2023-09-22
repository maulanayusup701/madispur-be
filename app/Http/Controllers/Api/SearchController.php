<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct(){
        $this->search = new User();
    }

    public function UserSearch(Request $request){

        $search = request('search');
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  $this->search->getUserSearch($search),
        ]);
    }
}
