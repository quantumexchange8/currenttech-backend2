<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function task_index()
    {

        return view('projects.task_index', [
            'title' => trans('public.trader_withdrawal'),
            'records' => collect([1, 2, 3, 4, 5]),
        ]);
    }

    public function project_index()
    {

        return view('projects.project_index', [
            'title' => trans('public.trader_withdrawal'),
            'records' => collect([1, 2, 3, 4, 5]),
        ]);
    }

    public function project_details($id)
    {

        return view('projects.project_detail', [
            'title' => trans('public.trader_withdrawal'),
            'records' => collect([1, 2, 3, 4, 5]),
        ]);
    }
}
