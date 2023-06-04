<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard.index', [
            'title' => trans('public.trader_withdrawal'),
            'records' => $numbers = collect([1, 2, 3, 4, 5]),
        ]);
    }
}
