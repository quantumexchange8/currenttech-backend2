<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leaves;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
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
                    session(['leaves_history_search' => [
                        'employee_id' => $request->input('employee_id'),
                        'employee_name' => $request->input('employee_name'),
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ]]);
                    break;
                case 'reset':
                    session()->forget('leaves_history_search');
                    break;
                case 'approve':
                    $leave = Leaves::find($request->id);
                    $leave->status = Leaves::STATUS_APPROVED;
                    $leave->save();
                    break;
                case 'reject':
                    $leave = Leaves::find($request->id);
                    $leave->reason = $request->reason;
                    $leave->status = Leaves::STATUS_REJECTED;
                    $leave->save();
                    break;
            }
        }
        $search = session('leaves_history_search') ? session('leaves_history_search') : $search;


        return view('requests.leave_index', [
            'title' => trans('public.employee_ticket'),
            'records' => Leaves::get_leaves_table($search)->paginate(10),
            'search' => $search,
        ]);
    }

    public function getData($id)
    {
        $data = Leaves::with('user')->find($id);
        $data->leave_type = $data->getLeaveType();
        $data->from_date = Carbon::parse($data->from_date)->format('Y-m-d');
        $data->end_date = Carbon::parse($data->end_date)->format('Y-m-d');

        return response()->json($data);
    }
}
