<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
        	INSERT INTO departments
		(id, name, created_at, updated_at, deleted_at, department_head_id)
		VALUES
		    (1, 'admin dept', NOW(), NOW(), null, 1),
		    (2, 'admin dept2', NOW(), NOW(), null, null),
        	(3, 'admin dept3', NOW(), NOW(), null, null),
        	(4, 'admin dept4', NOW(), NOW(), null, null),
        	(5, 'admin dept5', NOW(), NOW(), null, null)
        ");
    }
}
