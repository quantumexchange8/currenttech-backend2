<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcements extends Model
{
    const CATEGORY_ANNOUNCEMENT = 1;
    const CATEGORY_ACTIVITY = 2;

    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
