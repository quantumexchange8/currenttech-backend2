<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use App\Models\Leaves;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();


        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required',
                'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:30720'
            ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $request->merge([
            'user_id' => $user->id,
        ]);

        $feedback = Feedbacks::create($request->all());

        $attachment = $request->file('attachment');
        if ($attachment) {
            $dateTime = Carbon::now()->format('Ymd_His');
            $file = $dateTime . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('uploads/feedbacks'), $file);
            $feedback->attachment = $file;
        }
        $feedback->save();

        $feedback->attachment = $feedback->attachment ? asset('uploads/feedbacks/' . $feedback->attachment) : null;


        return response()->json([
            'success' => 'true',
            'message' => 'Feedback submitted!',
            'data' => $feedback
        ]);
    }
}
