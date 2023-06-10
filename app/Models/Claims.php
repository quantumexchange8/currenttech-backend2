<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    const TYPE_CARPARK = 1;
    const TYPE_STATIONARY = 2;
    const TYPE_TRAVEL = 3;
    const TYPE_GIRFT = 4;
    const TYPE_ENTERTAINMENT = 5;
    const TYPE_OTHERS = 6;
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
