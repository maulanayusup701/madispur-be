<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Account\AccountAdminResource;
use App\Http\Resources\Account\AccountPesertaResource;
use App\Http\Resources\Account\AccountSuperAdminResource;

class SearchController extends Controller
{
    public function __construct(){
        $this->search = new Permission();
        $this->search = new Menu();
        $this->search = new User();
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

        $menus = MenuResource::collection($this->menu->getMenuSearch($search));
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

    public function AccountSuperAdminSearch(Request $request){
        $search = request('search');

        $peserta = AccountSuperAdminResource::collection($this->search->getAccountSuperAdminSearch($search));
        $paginate = new LengthAwarePaginator(
            $peserta->items(),
            $peserta->total(),
            $peserta->perPage(),
            $peserta->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => AccountSuperAdminResource::collection($paginate),
        ]);
    }

    public function AccountAdminSearch(Request $request){
        $search = request('search');

        $admin = AccountAdminResource::collection($this->search->getAccountAdminSearch($search));
        $paginate = new LengthAwarePaginator(
            $admin->items(),
            $admin->total(),
            $admin->perPage(),
            $admin->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  AccountAdminResource::collection($paginate),
        ]);
    }

    public function AccountPesertaSearch(Request $request){
        $search = request('search');

        $peserta = AccountPesertaResource::collection($this->search->getAccountPesertaSearch($search));
        $paginate = new LengthAwarePaginator(
            $peserta->items(),
            $peserta->total(),
            $peserta->perPage(),
            $peserta->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' =>  AccountPesertaResource::collection($paginate),
        ]);
    }
}
