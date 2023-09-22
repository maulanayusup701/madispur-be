<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function emailRequest()
    {
       //
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json([
                'status' => true,
                'message' => 'Email reset password telah dikirim',
                'body' => null
                ])
            : response()->json([
                'status' => false,
                'message' => 'Gagal mereset password',
                'body' => null
                ]);
    }

    public function showResetForm(Request $request, $token)
    {
        //
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
            'token' => 'required',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json([
                'status' => true,
                'message' => 'Password telah direset',
                'body' => null
            ])
            : response()->json([
                'status' => false,
                'message' => 'Gagal mereset password',
                'body' => null
            ]);
    }

}
