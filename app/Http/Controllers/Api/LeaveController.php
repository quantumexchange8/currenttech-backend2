<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leaves;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $leaves = Leaves::where('user_id', $user->id)->select('id', 'leave_type', 'from_date', 'end_date', 'days', 'status')->get();
        $leaves = $leaves->map(function ($leave) {
            $leave->month_year = Carbon::parse($leave->from_date)->format('M Y');
            $leave->status = $leave->getStatus()['text'];
            $leave->leave_type = $leave->getLeaveType();
            return $leave;
        });

        return response()->json([
            'success' => 'true',
            'message' => 'Leaves data retrieved!',
            'data' => $leaves->groupBy('month_year')->toArray()
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $leave = Leaves::find($id);
        if ($leave == null || $leave->user_id != $user->id) {
            return response()->json([
                'success' => 'false',
                'message' => 'Leave not found!',
            ], 404);
        }

        return response()->json([
            'success' => 'true',
            'message' => 'Leave data retrieved!',
            'data' => $leave
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();


        $validator = Validator::make(
            $request->all(),
            [
                'leave_type' => 'required|in:'. implode(',', Leaves::getTypesArray()),
                'from_date' => 'required|date|after:today',
                'end_date' => 'required|date|after_or_equal:from_date',
                'leave_reason' => 'required',
                'attachment' =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:30720'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $startDate = Carbon::parse($request->from_date);
        $endDate = Carbon::parse($request->end_date);
        $diffInDays = $startDate->diffInDays($endDate) + 1;



        $request->merge([
            'days' => $diffInDays,
            'status' => Leaves::STATUS_PENDING,
            'user_id' => $user->id,
        ]);


        $leaves = Leaves::create($request->all());

        $attachment = $request->file('attachment');
        if ($attachment) {
            $dateTime = Carbon::now()->format('Ymd_His');
            $file = $dateTime . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('/uploads/leaves'), $file);
            $leaves->attachment = $file;
        }
        $leaves->save();

        $leaves->attachment = $leaves->attachment ? asset('/uploads/leaves/' . $leaves->attachment) : null;

        return response()->json([
            'success' => 'true',
            'message' => 'Leave applied!',
            'data' => $leaves
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        $leave = Leaves::find($id);
        if ($leave == null || $leave->user_id != $user->id) {
            return response()->json([
                'success' => 'false',
                'message' => 'Leave not found!',
            ], 404);
        } elseif ($leave->status != Leaves::STATUS_PENDING) {
            return response()->json([
                'success' => 'false',
                'message' => 'Only pending status can be edit!',
            ], 401);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'leave_type' => 'required|in:'. implode(',', Leaves::getTypesArray()),
                'from_date' => 'required|date|after:today',
                'end_date' => 'required|date|after_or_equal:from_date',
                'leave_reason' => 'required',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:30720'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $startDate = Carbon::parse($request->from_date);
        $endDate = Carbon::parse($request->end_date);
        $diffInDays = $startDate->diffInDays($endDate) + 1;



        $request->merge([
            'days' => $diffInDays,
            'status' => Leaves::STATUS_PENDING,
            'user_id' => $user->id,
        ]);

        $leave->update($request->except(['attachment']));
        $attachment = $request->file('attachment');

        if ($attachment) {
            if ($leave->attachment) {
                // Delete the previous file if needed
                File::delete('uploads/leaves/' .$leave->attachment);
            }

            $dateTime = Carbon::now()->format('Ymd_His');
            $file = $dateTime . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('/uploads/leaves'), $file);
            $leave->attachment = $file;
        }
        $leave->save();

        $leave->attachment = $leave->attachment ? asset('/uploads/leaves/' . $leave->attachment) : null;

        return response()->json([
            'success' => 'true',
            'message' => 'Leave updated!',
            'data' => $leave
        ]);
    }

    public function delete(Request $request, $id)
    {
        $user = $request->user();
        $leave = Leaves::find($id);
        if ($leave == null || $leave->user_id != $user->id) {
            return response()->json([
                'success' => 'false',
                'message' => 'Leave not found!',
            ], 404);
        }
        $leave->delete();
        return response()->json([
            'success' => 'true',
            'message' => 'Leave deleted!',
        ], 201);
    }
}
