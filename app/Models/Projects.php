<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    const CATEGORY_NEW = 1;
    const CATEGORY_ENHANCEMENT = 2;
    const CATEGORY_MODIFICATION = 3;
    const CATEGORY_TECHNICAL = 4;

    const PRIORITY_NON_URGENT = 1;
    const PRIORITY_LESS_URGENT = 2;
    const PRIORITY_URGENT = 3;
    const PRIORITY_VERY_URGENT = 4;

    const TARGET_ALL = 1;
    const TARGET_MEMBER = 2;


    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     *   Return list of status codes and labels
     * @return array
     */
    public function getLevel ()
    {
        switch ($this->priority) {

            case self::PRIORITY_NON_URGENT:
                return trans('public.priority_1');
            case self::PRIORITY_LESS_URGENT:
                return trans('public.priority_2');
            case self::PRIORITY_URGENT:
                return trans('public.priority_3');

            default:
                return trans('public.priority_4');
        }
    }

    public function getType ()
    {
        switch ($this->category) {

            case self::CATEGORY_NEW:
                return trans('public.new');
            case self::CATEGORY_ENHANCEMENT:
                return trans('public.enhancement');
            case self::CATEGORY_MODIFICATION:
                return trans('public.modification');

            default:
                return trans('public.technical_issue');
        }
    }

    public function duration()
    {
        $end  = Carbon::parse($this->end_date);
        $start = Carbon::parse($this->start_date);
        return $end->diffInDays($start);
    }

    public function deadline()
    {
        $end  = Carbon::parse($this->end_date);
        $start = Carbon::parse('today');
        if ($end >= $start) {
            return $end->diffInDays($start);

        } else {
            return 0;
        }
    }

    public function members_query()
    {
        $members_array = explode('-', trim( $this->members, '-'));
        return User::whereIn('id', $members_array);
    }

    public function project_status()
    {
        $status = 'New Project';

        $tasks = $this->tasks()->get();
        if ($tasks->count() > 0) {
            $array = $tasks->pluck('status')->toArray();
            if (count(array_unique($array)) === 1   ) {
                if (in_array(Tasks::STATUS_COMPLETED, $array, true)) {
                    $status = 'Completed';
                } elseif (in_array(Tasks::STATUS_PLANNED, $array, true)) {
                    $status = 'New Project';
                } else {
                    $status = 'In Progress';
                }
            } else {
                $status = 'In Progress';
            }
        }

        return $status;
    }

    public function project_progress()
    {
        $tasks_query = $this->tasks();
        $all_tasks = $tasks_query->get()->count();

        if ($all_tasks > 0) {
            $completed_tasks = $tasks_query->where('status', Tasks::STATUS_COMPLETED)->get()->count();

            return number_format($completed_tasks/$all_tasks * 100, 2, '.', '');
        }
        return number_format(0, 2, '.', '');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ProjectAttachments::class, 'project_id', 'id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Tasks::class, 'project_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
