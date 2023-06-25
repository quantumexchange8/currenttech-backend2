<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Tasks extends Model
{
    const TARGET_ALL = 1;
    const TARGET_MEMBER = 2;

    const STATUS_PLANNED = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_UNDER_REVIEW = 3;
    const STATUS_COMPLETED = 4;
    const STATUS_OVERDUE = 5;


    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function get_tasks_table($search)
    {

        $query = Tasks::query();
        $search_text = @$search['project_name'] ?? NULL;
        $freetext = explode(' ', $search_text);

        if($search_text){
            foreach($freetext as $freetexts) {
                $query->whereHas('project', function ($q) use ($freetexts) {
                    $q->where('name', 'like', '%' . $freetexts . '%');
                });
            }
        }


        if (@$search['start_date'] && @$search['end_date']) {
            $start_date = Carbon::parse(@$search['start_date'])->startOfDay()->format('Y-m-d H:i:s');
            $end_date = Carbon::parse(@$search['end_date'])->endOfDay()->format('Y-m-d H:i:s');
            $query->whereBetween('due_date', [$start_date, $end_date]);
        }

        $category = @$search['project_category'] ?? NULL;
        if ($category) {
            $query->whereHas('project', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }

        if (@$search['status'] ) {
            $query->where('status', @$search['status']);
        }

        return $query->orderbyDesc('created_at');
    }

    public function getStatus()
    {
        $statusText = match ($this->status) {
            self::STATUS_IN_PROGRESS => trans('public.in_progress'),
            self::STATUS_UNDER_REVIEW => trans('public.under_review'),
            self::STATUS_COMPLETED => trans('public.completed'),
            self::STATUS_OVERDUE => trans('public.overdue'),
            default => trans('public.planned'),
        };

        $statusClass = match ($this->status) {
            self::STATUS_IN_PROGRESS => 'fa fa-clock text-warning',
            self::STATUS_UNDER_REVIEW => 'fa fa-search text-secondary',
            self::STATUS_COMPLETED => 'fa fa-check-circle text-success',
            self::STATUS_OVERDUE => 'fa fa-exclamation-circle text-danger',
            default => 'fa fa-info-circle text-primary',
        };

        return [
            'text' => $statusText,
            'class' => $statusClass,
        ];
    }

    public function project() {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
