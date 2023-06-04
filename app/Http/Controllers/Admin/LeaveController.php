<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {

        return view('requests.leave_index', [
            'title' => trans('public.trader_withdrawal'),
            'records' => collect([1, 2, 3, 4, 5]),
        ]);
    }
}
