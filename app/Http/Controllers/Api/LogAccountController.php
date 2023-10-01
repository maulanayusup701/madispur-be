<?php

namespace App\Http\Controllers\Api;

use App\Models\LogAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LogAccountResource;
use Illuminate\Pagination\LengthAwarePaginator;

class LogAccountController extends Controller
{
    public function construct(){
        $this->log = new LogAccount;
    }

    public function index(){
        $logs = LogAccountResource::collection($this->log->getAllLogAccount());
        $paginate = new LengthAwarePaginator(
            $logs->items(),
            $logs->total(),
            $logs->perPage(),
            $logs->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'list Menu',
            'data' => [
                'current_page' => $paginate->currentPage(),
                'total' => $paginate->total(),
                'per_page' => $paginate->perPage(),
                'data' => LogAccountResource::collection($paginate),
            ],
        ]);
    }
}
