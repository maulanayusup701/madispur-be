<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShowRoleResource;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Account\AccountAdminResource;
use App\Http\Resources\Account\DetailAccountAdminResource;

class AccountAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->account = new User;
        $this->role = new Role;
    }

    public function index()
    {
        $account_admin = AccountAdminResource::collection($this->account->getAllAccountAdmin());
        $paginate_account_admin = new LengthAwarePaginator(
            $account_admin->items(),
            $account_admin->total(),
            $account_admin->perPage(),
            $account_admin->currentPage()
        );

        return response()->json([
            'status' => true,
            'message' => 'list Account Admin',
            'data' => [
                'current_page' => $account_admin->currentPage(),
                'total' => $account_admin->total(),
                'per_page' => $account_admin->perPage(),
                'data' => AccountAdminResource::collection($paginate_account_admin)
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'status' => true,
            'message' => 'create Account Admin',
            'data'  => $this->role->getAllRole()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'username' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'no_handphone' => 'required|numeric|digits_between:12,13',
            'gender' => ['required', Rule::in(['Pria', 'Wanita', 'Lainnya']),],
            'alamat_lengkap' => 'required|max:255',
        ]);

        $customMessages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'min' => ':attribute harus memiliki setidaknya :min karakter.',
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['role_id'] = 2;
        $data['create_date'] = now()->format('Y-m-d H:i:s');
        $data['create_by'] = auth()->user()->nama_lengkap;

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Account Super Admin berhasil di update',
            'data' => null
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'Show Detail Account Admin',
            'data' => new DetailAccountAdminResource($this->account->findUser($id))
        ]);
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'update Account Admin',
            'data' => [
                'user' => new DetailAccountAdminResource($this->account->findUser($id)),
                'role' => ShowRoleResource::collection($this->role->getAllRole())]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = $this->account->findUser($id);

        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'email' => 'required|email|max:255',
            'username' => 'required|max:255',
            'nama_lengkap' => 'required|max:255',
            'no_handphone' => 'required|numeric|digits_between:12,13',
            'gender' => ['required', Rule::in(['Pria', 'Wanita', 'Lainnya']),],
            'alamat_lengkap' => 'required|max:255',
        ]);

        $customMessages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'min' => ':attribute harus memiliki setidaknya :min karakter.',
        ];

        $validator->setCustomMessages($customMessages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Ada kesalahan',
                'data' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['update_date'] = now()->format('Y-m-d H:i:s');
        $data['update_by'] = auth()->user()->nama_lengkap;

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Account Admin berhasil di update',
            'data' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'Account Admin Berhasil Di Hapus',
            'data' => null
        ]);
    }
}
