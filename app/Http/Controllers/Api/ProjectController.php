<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\Projects;
use App\Models\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $projects = Projects::select('id', 'name', 'category', 'description', 'start_date', 'end_date', 'members', 'priority')->where('members', 'like', '%-' . $user->id . '-%')->get();
        foreach ($projects as $key => $project) {
            if ($request->status && $request->status != $project->project_status()) {
                unset($projects[$key]);
                continue;
            }

            $project->members = $project->members_query()->select('id', 'name', 'profile_picture')->get();
            $project->status = $project->project_status();
            $project->category = $project->getType();
            $project->priority = $project->getLevel();
            $project->progress = $project->project_progress();
            $project->task_count = $project->tasks()->count();
            $projects[$key] = $project;
        }
        $groupedProjects = $projects->groupBy('status');

        $countByStatus = $groupedProjects->map(function ($group) {
            return $group->count();
        });
        $additional_data = [];
        $additional_data['count_by_status'] = $countByStatus;
        if ($request->status && $request->status == 'In Progress') {
            $completed_tasks = $ongoing_tasks = $due_tasks = 0;
            $currentDate = Carbon::now();
            $nextWeekStartDate = $currentDate->copy()->startOfWeek()->addWeek();
            $nextWeekEndDate = $currentDate->copy()->endOfWeek()->addWeek();

            foreach ($groupedProjects['In Progress'] as $project) {
                $ongoing_tasks += $project->tasks()->where('status', '!=',  Tasks::STATUS_COMPLETED)->count();
                $completed_tasks += $project->tasks()->where('status', Tasks::STATUS_COMPLETED)->count();
                $due_tasks += $project->tasks()->whereBetween('due_date', [$nextWeekStartDate, $nextWeekEndDate])->where('status', '!=',  Tasks::STATUS_COMPLETED)->count();
            }

            $additional_data['completed_tasks'] = $completed_tasks;
            $additional_data['ongoing_tasks'] = $ongoing_tasks;
            $additional_data['due_tasks'] = $due_tasks;
        }

        return response()->json([
            'success' => 'true',
            'message' => 'Project data retrieved!',
            'data' => [
                'projects' => $groupedProjects,
                'additional_data' => $additional_data,
            ]
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $project = Projects::select('id', 'name', 'category', 'description', 'start_date', 'end_date', 'members', 'priority')->where('members', 'like', '%-' . $user->id . '-%')->find($id);
        if ($project == null) {
            return response()->json([
                'success' => 'false',
                'message' => 'Project not found!',
            ], 404);
        }
        $project->members = $project->members_query()->select('id', 'name', 'profile_picture')->get();
        $project->status = $project->project_status();
        $project->category = $project->getType();
        $project->priority = $project->getLevel();
        $project->progress = $project->project_progress();
        $project->tasks = $project->tasks()->select('id', 'name', 'status')->get();
        return response()->json([
            'success' => 'true',
            'message' => 'Project data retrieved!',
            'data' => $project
        ]);
    }

    public function complete(Request $request, $id)
    {
        $user = $request->user();
        $task = Tasks::where('members', 'like', '%-' . $user->id . '-%')->find($id);
        if ($task == null) {
            return response()->json([
                'success' => 'false',
                'message' => 'Task not found!',
            ], 404);
        } elseif ($task->status == Tasks::STATUS_UNDER_REVIEW || $task->status == Tasks::STATUS_COMPLETED) {
            return response()->json([
                'success' => 'false',
                'message' => 'Task under review or completed!',
            ], 404);
        }

        $task->status = Tasks::STATUS_UNDER_REVIEW;
        $task->save();

        return response()->json([
            'success' => 'true',
            'message' => 'Project marked as under reviewed!',
            'data' => $task
        ]);
    }
}
