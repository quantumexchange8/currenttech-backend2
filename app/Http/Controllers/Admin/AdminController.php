<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

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
            'title' => trans('public.sub_admin'),
            'input' => $input,
            'records' => $admins,
            'admin_options' => $users_without_admin->pluck('name', 'id')->toArray(),
            'admin_roles' =>array(
                User::TYPE_ADMIN => trans('public.super_admin'),
                User::TYPE_SUBADMIN => trans('public.sub_admin'),
            ),
        ])->withErrors($validator);
    }

    public function detail($id )
    {
            $user = User::find($id);


        $permissions = Permission::all()->pluck('name', 'id')->toArray();

        return view('admin.detail', [
            'title' => trans('public.sub_admin_permission'),
            'permissions' =>  array_chunk($permissions, ceil(count($permissions) / 2)),
            'user_permissions' => $user->getPermissionNames()->toArray(),
            'user' => $user,
        ]);
    }

    public function updatePermissions(Request $request, $id)
    {
        // Retrieve data from the request
        $permission = $request->input('permission');

        $user = User::find($id);
        $submit_type = $request->input('type');

        switch ($submit_type) {
            case 'give':
                $user->givePermissionTo($permission);
                break;
            case 'revoke':
                $user->revokePermissionTo($permission);
                break;
        }

        $response = [
            'status' => 'success',
            'message' => 'Permission updated',
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    //TODO::apply the function during the edit function
//    function transferPermissions(User $userA, User $userB)
//    {
//        // Get all permissions assigned to User A
//        $permissions = $userA->permissions;
//
//        // Sync the permissions to User B
//        $userB->syncPermissions($permissions);
//
//        // Optionally, you can also remove the permissions from User A
//        $userA->syncPermissions([]);
//
//        // Return true to indicate the transfer was successful
//        return true;
//    }

}
