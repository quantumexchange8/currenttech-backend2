<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password as PasswordSupport;

class ForgotPasswordController extends Controller
{

    public function postForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = PasswordSupport::sendResetLink(
            ['email' => $request->email]
        );
        return $status === PasswordSupport::RESET_LINK_SENT
            ? back()->with(['success_msg' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
