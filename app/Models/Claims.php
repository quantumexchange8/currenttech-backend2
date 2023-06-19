<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claims extends Model
{
    const TYPE_CARPARK = 1;
    const TYPE_STATIONARY = 2;
    const TYPE_TRAVEL = 3;
    const TYPE_GIFT = 4;
    const TYPE_ENTERTAINMENT = 5;
    const TYPE_OTHERS = 6;
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;

    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getClaimType()
    {
        return match ($this->claim_type) {
            self::TYPE_CARPARK => trans('public.type_carpark'),
            self::TYPE_STATIONARY => trans('public.type_stationary'),
            self::TYPE_TRAVEL => trans('public.type_travel'),
            self::TYPE_GIFT => trans('public.type_gift'),
            self::TYPE_ENTERTAINMENT => trans('public.type_entertainment'),
            default => trans('public.type_others'),
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

    public static function get_claims_table($search)
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
        if(!empty($employee_name)){
            $name_array = self::query()->where(function ($query) use ($employee_name) {
                foreach($employee_name as $freetexts) {
                    $query->whereHas('user', function ($q) use ($freetexts) {
                        $q->where('name', 'like', '%' . $freetexts . '%');
                    });
                }
            })->pluck('user_id')->unique()->toArray();
        }
        if($employee_id){
            $id_array = self::query()->where(function ($query) use ($employee_id) {
                foreach($employee_id as $freetexts) {
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
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        return $query->orderbyDesc('created_at');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
