<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leaves extends Model
{
    const TYPE_ANNUAL = 1;
    const TYPE_SICK = 2;
    const TYPE_HOSPITALISATION = 3;
    const TYPE_COMPASSIONATE = 4;
    const TYPE_MATERNITY = 5;
    const TYPE_PATERNITY = 6;
    const TYPE_CASUAL = 7;
    const TYPE_UNPAID = 8;
    const TYPE_COVID = 9;
    const TYPE_OTHERS = 10;

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;

    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function getTypesArray()
    {
        return[
            self::TYPE_ANNUAL,
            self::TYPE_SICK,
            self::TYPE_HOSPITALISATION,
            self::TYPE_COMPASSIONATE,
            self::TYPE_MATERNITY,
            self::TYPE_PATERNITY,
            self::TYPE_CASUAL,
            self::TYPE_UNPAID,
            self::TYPE_COVID,
            self::TYPE_OTHERS
        ];
    }

    public function getLeaveType()
    {
        return match ($this->leave_type) {
            self::TYPE_SICK => trans('public.type_sick'),
            self::TYPE_HOSPITALISATION => trans('public.type_hospitalisation'),
            self::TYPE_COMPASSIONATE => trans('public.type_compassionate'),
            self::TYPE_MATERNITY => trans('public.type_maternity'),
            self::TYPE_PATERNITY => trans('public.type_paternity'),
            self::TYPE_CASUAL => trans('public.type_casual'),
            self::TYPE_UNPAID => trans('public.type_unpaid'),
            self::TYPE_COVID => trans('public.type_covid'),
            self::TYPE_OTHERS => trans('public.type_others'),
            default => trans('public.type_annual'),
        };
    }

    public function checkPendingStatus()
    {
        if ($this->status == self::STATUS_PENDING)
            return true;
        else
            return false;
    }

    public function getStatus()
    {
        $statusText = match ($this->status) {
            self::STATUS_APPROVED => trans('public.approved'),
            self::STATUS_REJECTED => trans('public.rejected'),
            default => trans('public.pending'),
        };

        $statusClass = match ($this->status) {
            self::STATUS_APPROVED => 'text-success',
            self::STATUS_REJECTED => 'text-danger',
            default => 'text-warning',
        };

        return [
            'text' => $statusText,
            'class' => $statusClass,
        ];
    }

    public static function get_leaves_table($search)
    {
        $query = self::query();
        $name_array = [];
        $id_array = [];

        $employee_id = @$search['employee_id'] ?? NULL;
        if ($employee_id !== null) {
            $employee_id = explode(' ', $employee_id);
        }
        $employee_name = @$search['employee_name'] ?? NULL;
        if ($employee_name !== null) {
            $employee_name = explode(' ', $employee_name);
        }
        if (!empty($employee_name)) {
            $name_array = self::query()->where(function ($query) use ($employee_name) {
                foreach ($employee_name as $freetexts) {
                    $query->whereHas('user', function ($q) use ($freetexts) {
                        $q->where('name', 'like', '%' . $freetexts . '%');
                    });
                }
            })->pluck('user_id')->unique()->toArray();
        }
        if ($employee_id) {
            $id_array = self::query()->where(function ($query) use ($employee_id) {
                foreach ($employee_id as $freetexts) {
                    $query->whereHas('user', function ($q) use ($freetexts) {
                        $q->where('employee_id', 'like', '%' . $freetexts . '%');
                    });
                }
            })->pluck('user_id')->unique()->toArray();
        }

        $combinedUniqueArray = array_unique(array_merge($name_array, $id_array));

        if ($combinedUniqueArray) {
            $query->whereHas('user', function ($q) use ($combinedUniqueArray) {
                $q->whereIn('id', $combinedUniqueArray);
            });
        }


        if (@$search['start_date'] && @$search['end_date']) {
            $start_date = Carbon::parse(@$search['start_date'])->startOfDay()->format('Y-m-d H:i:s');
            $end_date = Carbon::parse(@$search['end_date'])->endOfDay()->format('Y-m-d H:i:s');
            $query->whereBetween('from_date', [$start_date, $end_date]);
        }

        return $query->orderbyDesc('from_date');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
