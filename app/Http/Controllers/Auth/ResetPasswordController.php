<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as PasswordSupport;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPasswordController extends Controller
{
    public function getResetPassword(Request $request)
    {
        $token = $request->token;
        $email = $request->email;

        if (!$token || !$email) {
            return redirect('/');
        }
        return view('auth.reset_password', ['token' => $token, 'email' => $email]);
    }

    public function postResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'confirmed'],
        ]);


        $status = PasswordSupport::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
                Alert::success(trans('public.done'), trans('public.success_reset'));
            }
        );
        return $status === PasswordSupport::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['password' => __($status)]);
    }
}
