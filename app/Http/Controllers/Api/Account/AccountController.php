<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Account\AccountAdminResource;
use App\Http\Resources\Account\AccountPesertaResource;
use App\Http\Resources\Account\AccountSuperAdminResource;

class AccountController extends Controller
{
    public function __construct(){
        $this->account = new User;
    }

    public function index(){
        $account_superAdmin = AccountSuperAdminResource::collection($this->account->getAllAccountSuperAdmin());
        $paginate_account_superAdmin = new LengthAwarePaginator(
            $account_superAdmin->items(),
            $account_superAdmin->total(),
            $account_superAdmin->perPage(),
            $account_superAdmin->currentPage()
        );

        $account_admin = AccountAdminResource::collection($this->account->getAllAccountAdmin());
        $paginate_account_admin = new LengthAwarePaginator(
            $account_admin->items(),
            $account_admin->total(),
            $account_admin->perPage(),
            $account_admin->currentPage()
        );

        $account_peserta = AccountPesertaResource::collection($this->account->getAllAccountPeserta());
        $paginate_account_peserta = new LengthAwarePaginator(
            $account_peserta->items(),
            $account_peserta->total(),
            $account_peserta->perPage(),
            $account_peserta->currentPage()
        );

        return response()->json([
            'status' => true,
            'message' => 'list Account',
            'data' => [
                'account_superAdmin' => [
                    'current_page' => $account_superAdmin->currentPage(),
                    'total' => $account_superAdmin->total(),
                    'per_page' => $account_superAdmin->perPage(),
                    'data' => AccountSuperAdminResource::collection($paginate_account_superAdmin),
                ],

                'account_admin' => [
                    'current_page' => $account_admin->currentPage(),
                    'total' => $account_admin->total(),
                    'per_page' => $account_admin->perPage(),
                    'data' => AccountAdminResource::collection($paginate_account_admin),
                ],

                'account_peserta' => [
                    'current_page' => $account_peserta->currentPage(),
                    'total' => $account_peserta->total(),
                    'per_page' => $account_peserta->perPage(),
                    'data' => AccountPesertaResource::collection($paginate_account_peserta),
                ],
            ]
        ]);
    }
}
