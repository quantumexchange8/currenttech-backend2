<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    const TARGET_ALL = 1;
    const TARGET_MEMBER = 2;


    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
