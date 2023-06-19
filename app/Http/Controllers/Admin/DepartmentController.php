<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $validator = null;
        $input = null;

        $departments = Departments::query()->orderbyDesc('created_at')->paginate(3);
        $department_heads_array = Departments::whereNotNull('department_head_id')->pluck('department_head_id')->toArray();
        $users_without_admin = User::whereNotIn('id', $department_heads_array);

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'department_name' => 'required',
                'department_head' => 'required',
            ])->setAttributeNames([
                'department_name' => trans('public.department_name'),
                'department_head' => trans('public.department_head'),
            ]);

            if (!$validator->fails()) {
                $department = Departments::create([
                    'name' => $request->input('department_name'),
                    'department_head_id' => $request->input('department_head'),
                ]);
                $user = User::find($request->input('department_head'));
                $user->department_id = $department->id;
                $user->save();
                Alert::success(trans('public.success'), trans('public.successfully_added_department'));
                return redirect()->route('departments_index');
            }

            $input = (object) $request->all();
        }


        return view('departments.index', [
            'title' => trans('public.department'),
            'input' => $input,
            'records' => $departments,
            'head_options' => $users_without_admin->pluck('name', 'id')->toArray()
        ])->withErrors($validator);
    }

    public function delete(Request $request)
    {
        $department = Departments::find($request->input('id'));

        if (!$department) {
            dd($department, $request->input('id'));
            Alert::error(trans('public.invalid_department'), trans('public.try_again'));
            return redirect()->route('departments_index');
        }

        foreach($department->members as $user) {
            $user->department_id = null;
            $user->save();
        }

        $department->delete();

        Alert::success(trans('public.success'), trans('public.successfully_deleted_department'));
        return redirect()->route('departments_index');
    }
}
