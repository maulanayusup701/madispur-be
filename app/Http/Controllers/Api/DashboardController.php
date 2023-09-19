<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProfileResource;

class DashboardController extends Controller
{
    public function __construct(){
        $this->profile = new User();
    }

    public function profile()
    {
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => new ProfileResource($this->profile->getProfileUser())
        ], 200);
    }
}