<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const RACE_CHINESE = 1;
    const RACE_MALAY = 2;
    const RACE_INDIAN = 3;
    const RACE_OTHER = 4;

    const MARITIAL_STATUS_SINGLE = 1;
    const MARITIAL_STATUS_MARRIED = 2;
    const MARITIAL_STATUS_DIVORCED = 3;
    const MARITIAL_STATUS_WIDOWED = 4;

    const EMPLOYMENT_TYPE_PERMENANT = 1;
    const EMPLOYMENT_TYPE_PROBATION = 2;
    const EMPLOYMENT_TYPE_PARTIME = 3;
    const EMPLOYMENT_TYPE_FREELANCER = 4;
    const EMPLOYMENT_TYPE_INTERN = 5;

    const TYPE_ADMIN = 1;
    const TYPE_SUBADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function getAdminType($type)
    {
        return match ($type) {
            self::TYPE_SUBADMIN => trans('public.sub_admin'),
            default => trans('public.super_admin'),
        };
    }





    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function listGender()
    {
        return [
            self::GENDER_MALE => trans('public.male'),
            self::GENDER_FEMALE => trans('public.female'),
        ];
    }

    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function listNationality()
    {
        return [
            true => trans('public.malaysian'),
            false => trans('public.foreign'),
        ];
    }

    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function listRace()
    {
        return [
            self::RACE_CHINESE => trans('public.chinese'),
            self::RACE_MALAY => trans('public.malay'),
            self::RACE_INDIAN => trans('public.indian'),
            self::RACE_OTHER => trans('public.others'),
        ];
    }

    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function listMaritialStatus()
    {
        return [
            self::MARITIAL_STATUS_SINGLE => trans('public.single'),
            self::MARITIAL_STATUS_MARRIED => trans('public.married'),
            self::MARITIAL_STATUS_DIVORCED => trans('public.divorced'),
            self::MARITIAL_STATUS_WIDOWED => trans('public.widowed'),
        ];
    }

    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function listEmploymentType()
    {
        return [
            self::EMPLOYMENT_TYPE_PERMENANT => trans('public.permanent'),
            self::EMPLOYMENT_TYPE_PROBATION => trans('public.probation'),
            self::EMPLOYMENT_TYPE_PARTIME => trans('public.part_timer'),
            self::EMPLOYMENT_TYPE_FREELANCER => trans('public.freelancer'),
            self::EMPLOYMENT_TYPE_INTERN => trans('public.internship'),
        ];
    }
    /**
     *   Return list of status codes and labels
     * @return array
     */
    public static function listBanks()
    {
        return [
            'Maybank' => 'Maybank',
            'CIMB Bank' => 'CIMB Bank',
            'Public Bank' => 'Public Bank',
            'RHB Bank' => 'RHB Bank',
            'Hong Leong Bank' => 'Hong Leong Bank',
            'Bank Islam' => 'Bank Islam',
            'AmBank' => 'AmBank',
            'OCBC Bank' => 'OCBC Bank',
            'Standard Chartered Bank' => 'Standard Chartered Bank',
            'UOB Bank' => 'UOB Bank',
            'HSBC Bank' => 'HSBC Bank',
            'Affin Bank' => 'Affin Bank',
            'Alliance Bank' => 'Alliance Bank',
            'Bank Muamalat' => 'Bank Muamalat',
            'Bank Rakyat' => 'Bank Rakyat',
            'MBSB Bank' => 'MBSB Bank',
            'Bank of China' => 'Bank of China',
            'Citibank' => 'Citibank',
        ];
    }

    public function setEmployeeId()
    {
        $temp_code = substr('CT0000', 0, 6 - strlen((string)$this->id));
        $this->employee_id = $temp_code . $this->id;
        $this->save();
    }

    public function getEmploymentType()
    {
        return match ($this->employment_type) {
            self::EMPLOYMENT_TYPE_PERMENANT => trans('public.permanent'),
            self::EMPLOYMENT_TYPE_PROBATION => trans('public.probation'),
            self::EMPLOYMENT_TYPE_PARTIME => trans('public.part_timer'),
            self::EMPLOYMENT_TYPE_FREELANCER => trans('public.freelancer'),
            self::EMPLOYMENT_TYPE_INTERN => trans('public.internship'),
            default => trans('public.permanent'),
        };
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }
}
