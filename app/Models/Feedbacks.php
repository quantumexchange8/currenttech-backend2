<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedbacks extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function get_tickets_table($search)
    {

        $query = Feedbacks::query();
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
