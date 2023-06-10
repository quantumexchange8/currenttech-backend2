<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
