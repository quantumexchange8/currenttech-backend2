<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = [
            'employee_id' => $request['username'],
            'password' => $request['password'],
        ];
        if (Auth::attempt($credentials)) {
            // dd($credentials);
            return redirect()->intended('admin/dashboard')
                ->withSuccess('Signed in');
        }
        Alert::error(trans('public.invalid_action'), trans('public.login_invalid'));
        return redirect("/");
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
