<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $validator = null;
        $input = null;

        $admins = User::query()->where('admin_status', true)->orderbyDesc('created_at')->paginate(3);
        $users_without_admin = User::where('admin_status', false);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'admin_id' => 'required',
                'admin_role' => 'required',
            ])->setAttributeNames([
                'admin_id' => trans('public.employee'),
                'admin_role' => trans('public.role'),
            ]);

            if (!$validator->fails()) {
                $user = User::find($request->input('admin_id'));

                $update_info = [
                    'admin_status' => true,
                    'admin_type' => $request->input('admin_role'),
                ];

                $user->update($update_info);
                Alert::success(trans('public.success'), trans('public.successfully_added_department'));
                return redirect()->route('admin_index');
            }

            $input = (object) $request->all();
        }


        return view('admin.index', [
            'title' => trans('public.department'),
            'input' => $input,
            'records' => $admins,
            'admin_options' => $users_without_admin->pluck('name', 'id')->toArray(),
            'admin_roles' =>array(
                User::TYPE_ADMIN => trans('public.super_admin'),
                User::TYPE_SUBADMIN => trans('public.sub_admin'),
            ),
        ])->withErrors($validator);
    }


}
