<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this->role = new Role();
    }
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => new RoleResource($this->role->getAllRole()),
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
        $data['created_by'] = auth()->user()->username;
        $data['created_date'] = now();
        $data['modified_by'] = auth()->user()->username;
        $data['modified_date'] = now();

        return Role::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Role berhasil di simpan',
            'data' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json([
            'success' => true,
            'message' => 'success',
            'data' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
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
        $data['modified_by'] = auth()->user()->username;
        $data['modified_date'] = now();

        $role->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Permission berhasil di update',
            'data' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);

        return response()->json([
            'status' => true,
            'message' => 'Data Permission berhasil di hapus',
            'data' => null
        ]);
    }
}
