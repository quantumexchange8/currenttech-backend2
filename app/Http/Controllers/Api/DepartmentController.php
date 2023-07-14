<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Departments::query()->select('id', 'name', 'created_at');

        if ($request->search) {
            $departments->where('name', 'like', "%{$request->search}%");
        }

        return response()->json([
            'success' => 'true',
            'message' => 'Departments data retrieved!',
            'data' => $departments->get()
        ]);
    }

    public function show($id)
    {
        $department = Departments::select('id', 'name', 'created_at', 'department_head_id')->find($id);
        $result = [];
        if ($department == null) {
            return response()->json([
                'success' => 'false',
                'message' => 'Department not found!',
            ], 404);
        }
        $result['department'] = $department;
        $result['head'] = $department->head()->select('id', 'name', 'profile_picture', 'designation', 'contact', 'email')->first();
        $result['member'] = $department->members()->where('id', '!=', $department->department_head_id)->select('id', 'name', 'profile_picture', 'designation', 'contact', 'email')->get();
        return response()->json([
            'success' => 'true',
            'message' => 'Departments data retrieved!',
            'data' => $result
        ]);
    }
}
