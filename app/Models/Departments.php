<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function members()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }


    public function head() {
        return $this->hasOne(User::class, 'id', 'department_head_id');
    }
}
