<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return back()->with(
            'success',
            __($status)
        );
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', [
            'token' => $token
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'token'
            ),
            function (User $user, string $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                $user->setRememberToken(Str::random(60));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect('/login')->with('success', 'Password berhasil diubah')
            : back()->withErrors(['email' => __($status)]);
    }
}
