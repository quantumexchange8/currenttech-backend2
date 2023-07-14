<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Checkins;
use App\Models\Leaves;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckinController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $records = Checkins::where('user_id', $user->id)->select('id', 'address', 'remark', 'start_time', 'end_time')->get();

        return response()->json([
            'success' => 'true',
            'message' => 'Announcement data retrieved!',
            'data' => $records
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $currentDate = Carbon::today();
        $record = Checkins::whereDate('start_time', $currentDate)->where('user_id', $user->id)->whereNull('end_time')->first();

        switch ($request->type) {
            case 'checkin':
                if ($record) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not allow to check in twice per day!',
                    ], 401);
                }

                $validator = Validator::make(
                    $request->all(),
                    [
                        'address' => 'required',
                        'remark' => 'required',
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
                    'start_time' => Carbon::now(),
                    'user_id' => $user->id,
                ]);

                $record = Checkins::create($request->all());

                $attachment = $request->file('attachment');
                if ($attachment) {
                    $dateTime = Carbon::now()->format('Ymd_His');
                    $file = $dateTime . '_' . $attachment->getClientOriginalName();
                    $attachment->move(public_path('/uploads/checkins'), $file);
                    $record->attachment = $file;
                }
                $record->save();

                $record->attachment = $record->attachment ? asset('/uploads/checkins/' . $record->attachment) : null;

                break;

            case 'checkout':
                if ($record == null) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please check in first to proceed with the action!',
                    ], 401);
                }


                $now = Carbon::now();
                $start = Carbon::parse($record->start_time) ;
                $record->end_time = $now;
                $record->duration = $start->diff($now)->format('%H:%I:%S');
                $record->save();
                break;

            case 'rest':
                if ($record == null) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please check in first to proceed with the action!',
                    ], 401);
                }

                $record->rest_time = Carbon::now();
                $record->save();
                break;

            case 'lunch':
                if ($record == null) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please check in first to proceed with the action!',
                    ], 401);
                }

                $record->lunch_time = Carbon::now();
                $record->save();
                break;

            default:
                return response()->json([
                    'success' => 'false',
                    'message' => 'Type not found!',
                ], 404);
        }

        return response()->json([
            'success' => 'true',
            'message' => 'Leave applied!',
            'data' => $record
        ]);

    }
}
