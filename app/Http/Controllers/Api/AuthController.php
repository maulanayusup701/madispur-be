<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        //
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->tokens()->delete();
            $user->login_terakhir = now();
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => [
                    'token' => $user->createToken('authToken')->plainTextToken,
                    'nama_lengkap' => $user->nama_lengkap,
                ],
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal',
                'data' => null,
            ]);
        }
    }

    public function register()
    {
        //
    }

    public function registerStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required|in:3,4',
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
            'nama_kampus/sekolah' => 'required|max:255',
            'jurusan/prodi' => 'required|max:255',
            'kelas/semester' => ['required', Rule::in(['1', '2', '3', '4', '5', '6', '7', '8']),],
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

    public function emailVerify(Request $request, $id){
        $data = $request->hasValidSignature();
        $user = User::find($id);

        if($data){
            $user->markEmailAsVerified();
            $user->status = 'AKTIF';
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'Verifikasi Email Berhasil',
                'data' => null,
            ]);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'Verifikasi Email Gagal',
                'data' => null,
            ]);
        }
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',
            'data' => null,
        ]);
    }
}
