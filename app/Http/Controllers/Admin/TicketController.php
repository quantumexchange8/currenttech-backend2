<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedbacks;
use Illuminate\Http\Request;

class TicketController extends Controller
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

                    session(['tickets_history_search' => [
                        'employee_id' => $request->input('employee_id'),
                        'employee_name' => $request->input('employee_name'),
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ]]);
                    break;
                case 'reset':
                    session()->forget('tickets_history_search');
                    break;
            }
        }
        $search = session('tickets_history_search') ? session('tickets_history_search') : $search;


        return view('tickets.index', [
            'title' => trans('public.employee_ticket'),
            'records' => Feedbacks::get_tickets_table($search)->paginate(10),
            'search' => $search,
        ]);
    }
}
