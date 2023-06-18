<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkins;
use App\Models\Claims;
use App\Models\Feedbacks;
use App\Models\Leaves;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
                    session(['checkins_history_search' => [
                        'employee_id' => $request->input('employee_id'),
                        'employee_name' => $request->input('employee_name'),
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ]]);
                    break;
                case 'reset':
                    session()->forget('checkins_history_search');
                    break;
            }
        }
        $search = session('checkins_history_search') ? session('checkins_history_search') : $search;


        return view('dashboard.index', [
            'title' => trans('public.dashboard'),
            'records' => Checkins::get_checkins_table($search)->paginate(10),
            'leave_count' => Leaves::where('status', Leaves::STATUS_PENDING)->count(),
            'claim_count' => Claims::where('status', Claims::STATUS_PENDING)->count(),
            'ticket_count' => Feedbacks::all()->count(),
            'search' => $search,
        ]);

    }

    public function getData($id)
    {
        $data = Checkins::with('user')->find($id);

        return response()->json($data);
    }
}
