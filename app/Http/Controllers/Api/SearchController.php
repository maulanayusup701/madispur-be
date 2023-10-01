<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function __construct(){
        $this->search = new Permission();
        $this->search = new Menu();
    }

    public function permissionSearch(Request $request){
        $search = request('search');

        $permissions = PermissionResource::collection($this->search->getPermissionSearch($search));
        $paginate = new LengthAwarePaginator(
            $permissions->items(),
            $permissions->total(),
            $permissions->perPage(),
            $permissions->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  PermissionResource::collection($paginate),
        ]);
    }

    public function MenuSearch(Request $request){
        $search = request('search');

        $menus = MenuResource::collection($this->menu->getMenuSearch());
        $paginate = new LengthAwarePaginator(
            $menus->items(),
            $menus->total(),
            $menus->perPage(),
            $menus->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  MenuResource::collection($paginate),
        ]);
    }
}
