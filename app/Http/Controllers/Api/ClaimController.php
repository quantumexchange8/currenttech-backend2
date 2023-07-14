<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Claims;
use App\Models\Leaves;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $month = $request->month ?? Carbon::now()->month;
        $year = $request->year ?? Carbon::now()->year;
        $startDate = Carbon::create($year, $month)->startOfMonth();
        $endDate = Carbon::create($year, $month)->endOfMonth();
        $type = $request->type ?? 'history';
        $result = [];

        if($type == 'group') {


            $claims = Claims::where('user_id', 3)->whereBetween('date', [$startDate, $endDate])->where('status', Claims::STATUS_APPROVED)->groupBy('claim_type')
                ->selectRaw('sum(amount) as sum, claim_type')
                ->pluck('sum','claim_type');
            $modifiedData = collect($claims)->mapWithKeys(function ($value, $key) {
                // Modify the key according to your needs
                $modifiedKey = Claims::getClaimTypeWithKey($key);

                // Return the modified key-value pair
                return [$modifiedKey => $value];
            });

            $result['data'] = $modifiedData;
            $result['total'] = $claims->sum();
        } else {
            $claims = Claims::where('user_id', 3)->whereBetween('date', [$startDate, $endDate])->select('id', 'claim_type', 'amount', 'status', 'description', 'date')->get();

            $claims = $claims->map(function ($claim) {
                $claim->status = $claim->getStatus()['text'];
                $claim->claim_type = $claim->getClaimType();
                return $claim;
            });

            $result = $claims;
        }

        return response()->json([
            'success' => 'true',
            'message' => 'Claim data retrieved!',
            'data' => $result
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();


        $validator = Validator::make(
            $request->all(),
            [
                'claim_type' => 'required|in:' . implode(',', Claims::getClaimTypeArray()),
                'date' => 'required|date',
                'description' => 'required',
                'reason' => 'required',
                'merchant' => 'required',
                'amount' => 'required|numeric',
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
            'status' => Claims::STATUS_PENDING,
            'user_id' => $user->id,
        ]);

        $claim = Claims::create($request->all());

        $attachment = $request->file('attachment');
        if ($attachment) {
            $dateTime = Carbon::now()->format('Ymd_His');
            $file = $dateTime . '_' . $attachment->getClientOriginalName();
            $attachment->move(public_path('/uploads/claims'), $file);
            $claim->attachment = $file;
        }
        $claim->save();

        $claim->attachment = $claim->attachment ? asset('/uploads/claims/' . $claim->attachment) : null;

        return response()->json([
            'success' => 'true',
            'message' => 'Claim applied!',
            'data' => $claim
        ]);
    }
}
