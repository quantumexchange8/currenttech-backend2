<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
