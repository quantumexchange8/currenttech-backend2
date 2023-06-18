<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\ProjectAttachments;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
{
    public function task_index(Request $request)
    {

        $validator = null;
        $input = null;
        $auth_user = Auth::user();
        $search = array();

        if ($request->isMethod('post')) {

            $submit_type = $request->input('submit');

            switch ($submit_type) {
                case 'create':
                    $validator = Validator::make($request->all(), [
                        'project_name' => 'required',
                        'due_date' => 'required|date|after:today',
                        'task_name' => 'required',
                        'task_description' => 'required',
                        'notification_sent' => 'required',
                        'assigned_to' => 'required|array|min:1',
                    ])->setAttributeNames([
                        'project_name' =>  trans('public.project_name'),
                        'due_date' =>  trans('public.due_date'),
                        'task_name' =>  trans('public.task_name'),
                        'task_description' =>  trans('public.task_description'),
                        'notification_sent' =>  trans('public.notification_sent'),
                        'assigned_to' =>  trans('public.assigned_to'),
                    ]);

                    if (!$validator->fails()) {
                        $values = array_values($request->assigned_to);
                        $assigned_to = '-' . implode('-', $values) . '-';
                        $task = Tasks::create([
                            'name' => $request->input('task_name'),
                            'description' => $request->input('task_description'),
                            'due_date' => $request->input('due_date'),
                            'notification_target' => $request->input('notification_sent'),
                            'members' => $assigned_to,
                            'user_id' => $auth_user->id,
                            'project_id' => $request->input('project_name')
                        ]);


                        Alert::success(trans('public.success'), trans('public.successfully_created_task'));
                        return redirect()->route('tasks_index');
                    }

                    $input = (object) $request->all();
                    break;

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
                    session(['tasks_history_search' => [
                        'employee_id' => $request->input('employee_id'),
                        'employee_name' => $request->input('employee_name'),
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                    ]]);
                    break;
                case 'reset':
                    session()->forget('tasks_history_search');
                    break;
            }

        }

        $search = session('tasks_history_search') ? session('tasks_history_search') : $search;
        return view('projects.task_index', [
            'title' => trans('public.taskboard'),
            'records' =>  Tasks::get_tasks_table($search)->paginate(10),
            'notifications' => array(
                Projects::TARGET_ALL => trans('public.all_employees'),
                Projects::TARGET_MEMBER => trans('public.members_only'),
            ),
            'input' => $input,
            'projects' => Projects::all()->pluck('name', 'id')->toArray(),
            'search'=> $search,

        ])->withErrors($validator);

    }

    public function project_index(Request $request)
    {
        $validator = null;
        $input = null;
        $projects = Projects::query();
        $auth_user = Auth::user();

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'project_name' => 'required',
                'project_start_date' => 'required|date|after:today',
                'project_end_date' => 'required|date|after:project_start_date',
                'project_category' => 'required',
                'project_description' => 'required',
                'priority' => 'required',
                'notification_sent' => 'required',
                'assigned_to' => 'required|array|min:1',
            ])->setAttributeNames([
                'project_name' =>  trans('public.project_name'),
                'project_start_date' =>  trans('public.project_start_date'),
                'project_end_date' =>  trans('public.project_end_date'),
                'project_category' =>  trans('public.project_category'),
                'project_description' =>  trans('public.project_description'),
                'priority' =>  trans('public.priority'),
                'notification_sent' =>  trans('public.notification_sent'),
                'assigned_to' =>  trans('public.assigned_to'),
            ]);

            if (!$validator->fails()) {
                $values = array_values($request->assigned_to);
                $assigned_to = '-' . implode('-', $values) . '-';
                $project = Projects::create([
                    'name' => $request->input('project_name'),
                    'category' => $request->input('project_category'),
                    'description' => $request->input('project_description'),
                    'start_date' => $request->input('project_start_date'),
                    'end_date' => $request->input('project_end_date'),
                    'notification_target' => $request->input('notification_sent'),
                    'priority' => $request->input('priority'),
                    'members' => $assigned_to,
                    'user_id' => $auth_user->id,
                ]);

                $attachments = $request->project_information;
                if ($attachments) {
                    foreach ($attachments as $attachment) {
                        $file_attachment = time() . '.' . $attachment->getClientOriginalExtension();
                        $attachment->move(public_path('/uploads/projects'), $file_attachment);
                        ProjectAttachments::create([
                            'attachment' => $file_attachment,
                            'project_id' => $project->id,
                            'user_id' => $auth_user->id,
                        ]);
                    }
                };

                $project->save();

                Alert::success(trans('public.success'), trans('public.successfully_created_project'));
                return redirect()->route('projects_index');
            }

            $input = (object) $request->all();
        }


        return view('projects.project_index', [
            'title' => trans('public.project_dashboard'),
            'records' => $projects->get(),
            'priorities' => array(
                Projects::PRIORITY_NON_URGENT => trans('public.priority_1'),
                Projects::PRIORITY_LESS_URGENT => trans('public.priority_2'),
                Projects::PRIORITY_URGENT => trans('public.priority_3'),
                Projects::PRIORITY_VERY_URGENT => trans('public.priority_4'),
            ),
            'notifications' => array(
                Projects::TARGET_ALL => trans('public.all_employees'),
                Projects::TARGET_MEMBER => trans('public.members_only'),
            ),
            'categories' => array(
                Projects::CATEGORY_NEW => trans('public.new'),
                Projects::CATEGORY_ENHANCEMENT => trans('public.modification'),
                Projects::CATEGORY_MODIFICATION => trans('public.enhancement'),
                Projects::CATEGORY_TECHNICAL => trans('public.technical_issue'),
            ),
            'input' => $input,
            'users' => User::all()->pluck('name', 'id')->toArray(),

        ])->withErrors($validator);
    }

    public function project_details(Request $request, $id)
    {
        $record = Projects::find($id);

        if (!$record) {
            return redirect()->route('projects_index');
        }

        $validator = null;
        $input = (object) [
            'project_name' => $record->name,
            'project_start_date' => Carbon::createFromFormat('Y-m-d H:i:s', $record->start_date)->toDateString(),
            'project_end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $record->end_date)->toDateString(),
            'project_category' => $record->category,
            'project_description' => $record->description,
            'priority' => $record->priority,
            'notification_sent' => $record->notification_target,
            'assigned_to' => explode('-', trim( $record->members, '-')),
            ];

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'project_name' => 'required',
                'project_start_date' => 'required|date|after:today',
                'project_end_date' => 'required|date|after:project_start_date',
                'project_category' => 'required',
                'project_description' => 'required',
                'priority' => 'required',
                'notification_sent' => 'required',
                'assigned_to' => 'required|array|min:1',
            ])->setAttributeNames([
                'project_name' =>  trans('public.project_name'),
                'project_start_date' =>  trans('public.project_start_date'),
                'project_end_date' =>  trans('public.project_end_date'),
                'project_category' =>  trans('public.project_category'),
                'project_description' =>  trans('public.project_description'),
                'priority' =>  trans('public.priority'),
                'notification_sent' =>  trans('public.notification_sent'),
                'assigned_to' =>  trans('public.assigned_to'),
            ]);

            if (!$validator->fails()) {
                $values = array_values($request->assigned_to);
                $assigned_to = '-' . implode('-', $values) . '-';
                $update_info = [
                    'name' => $request->input('project_name'),
                    'category' => $request->input('project_category'),
                    'description' => $request->input('project_description'),
                    'start_date' => $request->input('project_start_date'),
                    'end_date' => $request->input('project_end_date'),
                    'notification_target' => $request->input('notification_sent'),
                    'priority' => $request->input('priority'),
                    'members' => $assigned_to,
                ];
                $record->update($update_info);

                Alert::success(trans('public.success'), trans('public.update_project'));
                return redirect()->route('project_details', $record->id);
            }

            $input = (object)$request->all();
            if (!array_key_exists('assigned_to', $request->all())) {
                $request1 = (object) $request->all();
                $request2 = (object) ['assigned_to' => []];

                $input = (object) array_merge((array) $request1, (array) $request2);
            }

        }

        return view('projects.project_detail', [
            'title' => trans('public.project_dashboard'),
            'record' => $record,
            'priorities' => array(
                Projects::PRIORITY_NON_URGENT => trans('public.priority_1'),
                Projects::PRIORITY_LESS_URGENT => trans('public.priority_2'),
                Projects::PRIORITY_URGENT => trans('public.priority_3'),
                Projects::PRIORITY_VERY_URGENT => trans('public.priority_4'),
            ),
            'notifications' => array(
                Projects::TARGET_ALL => trans('public.all_employees'),
                Projects::TARGET_MEMBER => trans('public.members_only'),
            ),
            'categories' => array(
                Projects::CATEGORY_NEW => trans('public.new'),
                Projects::CATEGORY_ENHANCEMENT => trans('public.modification'),
                Projects::CATEGORY_MODIFICATION => trans('public.enhancement'),
                Projects::CATEGORY_TECHNICAL => trans('public.technical_issue'),
            ),
            'input' => $input,
            'users' => User::all()->pluck('name', 'id')->toArray(),

        ])->withErrors($validator);

    }

    public function add_attachments(Request $request, $id)
    {
        $project = Projects::find($id);

        $attachments = $request->project_information;
        if ($attachments) {
            foreach ($attachments as $attachment) {
                $file_attachment = time() . '.' . $attachment->getClientOriginalExtension();
                $attachment->move(public_path('/uploads/projects'), $file_attachment);
                ProjectAttachments::create([
                    'attachment' => $file_attachment,
                    'project_id' => $project->id,
                    'user_id' => Auth::user()->id,
                ]);
            }
        };


        $project->save();

        Alert::success(trans('public.success'), trans('public.update_announcement'));
        return redirect()->route('project_details', $project->id);
    }

    public function getProjectData($id)
    {
        $data = Projects::find($id);

        $members = User::whereIn('id', explode('-', trim( $data->members, '-')))->get();

        return response()->json($members);
    }

    public function getTaskData($id)
    {
        $data = Tasks::find($id);

        return response()->json($data);
    }
}
