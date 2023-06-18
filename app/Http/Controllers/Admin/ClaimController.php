<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claims;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $search = array();

        if ($request->isMethod('post')) {
            $submit_type = $request->input('submit');

            switch ($submit_type) {
                case 'search':
                    if (is_null($request->input('start_date')) || is_null($request->input('end_date'))) {
                        $start_date = $end_date = $request->input('start_date') ?? $request->input('end_date');
                    } else {
                        if ($request->input('end_date') > $request->input('start_date')) {
                            $start_date = $request->input('start_date');
                            $end_date = $request->input('end_date');
                        } else {
                            $start_date = $request->input('end_date');
                            $end_date = $request->input('start_date');
                        }
                    }
                    session(['claims_history_search' => [
                        'employee_id' => $request->input('employee_id'),
                        'employee_name' => $request->input('employee_name'),
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ]]);
                    break;
                case 'reset':
                    session()->forget('claims_history_search');
                    break;
                case 'approve':
                    $leave = Claims::find($request->id);
                    $leave->status = Claims::STATUS_APPROVED;
                    $leave->save();
                    break;
                case 'reject':
                    $leave = Claims::find($request->id);
                    $leave->decline_reason = $request->decline_reason;
                    $leave->status = Claims::STATUS_REJECTED;
                    $leave->save();
                    break;
            }
        }
        $search = session('claims_history_search') ? session('claims_history_search') : $search;


        return view('requests.claim_index', [
            'title' => trans('public.employee_ticket'),
            'records' => Claims::get_claims_table($search)->paginate(10),
            'search' => $search,
        ]);

    }

    public function getData($id)
    {
        $data = Claims::with('user')->find($id);
        $data->claim_type = $data->getClaimType();
        $formattedCreatedAt = Carbon::parse($data->created_at)->format('Y-m-d');
        $data->formatted_created_at = $formattedCreatedAt;

        return response()->json($data);
    }
}
