<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    const CATEGORY_ANNOUNCEMENT = 1;
    const CATEGORY_ACTIVITY = 2;

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
