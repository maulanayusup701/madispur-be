<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Http\Resources\DetailMenuResource;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this->menu = new Menu();
    }

    public function index() 
    {
        $menus = MenuResource::collection($this->menu->getAllMenu());
        $paginate = new LengthAwarePaginator(
            $menus->items(),
            $menus->total(),
            $menus->perPage(),
            $menus->currentPage()
        );

        return response()->json([
            'success' => true,
            'message' => 'list Menu',
            'data' => [
                'current_page' => $paginate->currentPage(),
                'total' => $paginate->total(),
                'per_page' => $paginate->perPage(),
                'data' => MenuResource::collection($paginate),
            ],
        ]);
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
            'deskripsi' => 'required',
            'route' => 'required',
            'icon' =>  'required',

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
        Menu::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Menu berhasil di simpan',
            'data' => null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {   
        return response()->json([
            'status' => true,
            'message' => 'Data Menu berhasil di temukan',
            'data' => new DetailMenuResource($menu),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
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

        $menu->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data Menu berhasil di update',
            'data' => null
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);

        return response()->json([
            'status' => true,
            'message' => 'Data Menu berhasil di hapus',
            'data' => null
        ]);
    }
}
