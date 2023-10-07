<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Resources\Account\AccountPesertaResource;
use App\Http\Resources\Account\DetailAccountPesertaResource;

class AccountPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->account = new User;
    }

    public function index(){
        $account_peserta = AccountPesertaResource::collection($this->account->getAllAccountPeserta());
        $paginate_account_peserta = new LengthAwarePaginator(
            $account_peserta->items(),
            $account_peserta->total(),
            $account_peserta->perPage(),
            $account_peserta->currentPage()
        );

        return response()->json([
            'status' => true,
            'message' => 'list Account Peserta',
            'data' => [
                'current_page' => $account_peserta->currentPage(),
                'total' => $account_peserta->total(),
                'per_page' => $account_peserta->perPage(),
                'data' => AccountPesertaResource::collection($paginate_account_peserta)
            ]
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'Show Detail Account Peserta',
            'data' => new DetailAccountPesertaResource($this->account->findUser($id))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'Edit Peserta',
            'data' => New DetailAccountPesertaResource($this->findUser($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = $this->findUser($id);
        ($user->role_id===3)? $role_id = 3 : $role_id = 4;

        $validator = Validator::make($request->all(), [
            'NIM' => 'required_if:role_id,3|numeric|digits:16',
            'NISN' => 'required_if:role_id,4|numeric|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|max:255',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)/',
            ],
            'password_confirmation' => 'required|same:password',
            'nama_lengkap' => 'required|max:255',
            'no_handphone' => 'required|numeric|digits_between:12,13',
            'gender' => ['required', Rule::in(['Pria', 'Wanita', 'Lainnya']),],
            'alamat_lengkap' => 'required|max:255',
            'NIK' => 'required|numeric|digits:16',
            'nama_kampus_atau_sekolah' => 'required|max:255',
            'jurusan_atau_prodi' => 'required|max:255',
            'semenster' => ['required_if:role_id,3', Rule::in(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14']),],
            'kelas' => ['required_if:role_id,4', Rule::in(['1', '2', '3']),],
            'Keperluan' => 'required|max:255',
        ]);

        $customMessages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'min' => ':attribute harus memiliki setidaknya :min karakter.',
            'regex' => ':attribute harus mengandung setidaknya satu huruf kapital dan satu angka.',
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
        $data['password'] = bcrypt($data['password']);
        $data['login_terakhir'] = null;
        $data['status'] = 'TIDAK AKTIF';

        $user = User::create($data)->sendEmailVerificationNotification();

        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil, Silahkan Verifikasi Email',
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
            'message' => 'Account Peserta Berhasil Di Hapus',
            'data' => null
        ]);
    }
}
