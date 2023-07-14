<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Claims;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->select('id', 'name', 'contact', 'email', 'employee_id', 'joining_date', 'employment_type', 'offer_letter_attachment', 'permanent_attachment', 'profile_picture')->first();
        $user->offer_letter_attachment = $user->offer_letter_attachment ? asset('uploads/users/offer_letter.' . $user->offer_letter_attachment) : null;
        $user->permanent_attachment = $user->permanent_attachment ? asset('uploads/users/permanent_attachment.' . $user->permanent_attachment): null;
        $user->profile_picture = $user->profile_picture ? asset('uploads/users/profile_picture.' . $user->profile_picture): null;
        $user->employment_type = $user->getEmploymentType();
        return response()->json([
            'success' => 'true',
            'message' => 'User data retrieved!',
            'data' => $user
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user == null) {
            return response()->json([
                'success' => 'false',
                'message' => 'User not found!',
            ], 404);
        }

        return response()->json([
            'success' => 'true',
            'message' => 'User data retrieved!',
            'data' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make(
            $request->all(),
            [
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:30720'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $attachment = $request->file('profile_picture');
        if ($attachment) {
            if ($user->profile_picture) {
                // Delete the previous file if needed
                File::delete('/uploads/users/profile_picture/' .$user->profile_picture);
            }
            $dateTime = Carbon::now()->format('Ymd_His');
            $file = $dateTime . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('/uploads/users/profile_picture'), $file);
            $user->profile_picture = $file;
        }
        $user->save();

        $user->profile_picture = $user->profile_picture ? asset('/uploads/users/profile_picture/' . $user->profile_picture) : null;

        return response()->json([
            'success' => 'true',
            'message' => 'User data retrieved!',
            'data' => $user
        ]);
    }
}
