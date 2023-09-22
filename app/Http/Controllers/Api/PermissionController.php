<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\DetailPermissionResource;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this->permission = new Permission();
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => new PermissionResource($this->permission->getAllPermission()),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $customMessages = [
            'required' => 'Kolom :attribute wajib diisi.',
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
        $data['menu_id'] = 1;
        $data['created_by'] = auth()->user()->username;
        $data['created_date'] = now();
        $data['modified_by'] = auth()->user()->username;
        $data['modified_date'] = now();

        Permission::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Permission berhasil di simpan',
            'data' => null,
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $permission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $customMessages = [
            'required' => 'Kolom :attribute wajib diisi.',
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
        $data['menu_id'] = 1;
        $data['modified_by'] = auth()->user()->username;
        $data['modified_date'] = now();

        $permission->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Permission berhasil di update',
            'data' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(permission $permission)
    {
        Permission::destroy($permission->id);

        return response()->json([
            'status' => true,
            'message' => 'Data Permission berhasil di hapus',
            'data' => null
        ]);
    }
}
