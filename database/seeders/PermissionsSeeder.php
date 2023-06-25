<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'access_dashboard']);
        Permission::create(['name' => 'view_leave']);
        Permission::create(['name' => 'view_claim']);
        Permission::create(['name' => 'view_ticket']);
        Permission::create(['name' => 'view_attendance']);

        Permission::create(['name' => 'access_department']);
        Permission::create(['name' => 'add_department']);
        Permission::create(['name' => 'edit_department']);
        Permission::create(['name' => 'delete_department']);
        Permission::create(['name' => 'view_department_details']);

        Permission::create(['name' => 'access_project_dashboard']);
        Permission::create(['name' => 'add_project']);
        Permission::create(['name' => 'edit_project']);
        Permission::create(['name' => 'delete_project']);
        Permission::create(['name' => 'view_project_details']);
        Permission::create(['name' => 'add_project_member']);
        Permission::create(['name' => 'view_project_attachment']);

        Permission::create(['name' => 'access_payroll']);
        Permission::create(['name' => 'add_salary']);
        Permission::create(['name' => 'edit_salary']);
        Permission::create(['name' => 'delete_salary']);
        Permission::create(['name' => 'view_salary_details']);

        Permission::create(['name' => 'access_taskboard']);
        Permission::create(['name' => 'add_task']);
        Permission::create(['name' => 'edit_task']);
        Permission::create(['name' => 'delete_task']);
        Permission::create(['name' => 'view_task_details']);

        Permission::create(['name' => 'access_announcement']);
        Permission::create(['name' => 'add_announcement']);
        Permission::create(['name' => 'edit_announcement']);
        Permission::create(['name' => 'delete_announcement']);
        Permission::create(['name' => 'view_announcement_details']);

        Permission::create(['name' => 'access_employee']);
        Permission::create(['name' => 'add_employee']);
        Permission::create(['name' => 'edit_employee']);
        Permission::create(['name' => 'delete_employee']);
        Permission::create(['name' => 'view_employee_details']);
        Permission::create(['name' => 'view_employee_agreements']);

        Permission::create(['name' => 'access_subadmin']);
        Permission::create(['name' => 'add_subadmin']);
        Permission::create(['name' => 'edit_subadmin']);
        Permission::create(['name' => 'delete_subadmin']);
        Permission::create(['name' => 'view_subadmin_permissions']);


        User::find(1)->givePermissionTo(Permission::all());
    }
}
