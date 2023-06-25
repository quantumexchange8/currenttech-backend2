<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ClaimController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get("localization/{lange}", [LocalizationController::class, "setLang"]);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot_password');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post('/post_login', 'login')->name('post_login');
    });


    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('/post_forgot_password', 'postForgotPassword')->name('post_forgot_password');
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/reset-password', 'getResetPassword')->name('password.reset');
        Route::post('/post_reset_password', 'postResetPassword')->name('post_reset_password');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout']);


    Route::prefix('admin')->group(function() {
        Route::controller(DashboardController::class)->group(function () {
            Route::match(['get', 'post'], '/dashboard', 'index')->name('dashboard');
            Route::get('/get_checkin_data/{id}', 'getData')->name('get_checkin_data');
        });
        Route::controller(AdminController::class)->group(function () {
            Route::match(['get', 'post'], '/subadmin', 'index')->name('admin_index');
            Route::get('/admin_detail/{id}', 'detail')->name('admin_detail');
            Route::post('/update_permissions/{id}', 'updatePermissions')->name('update_permissions');
        });
        Route::controller(DepartmentController::class)->group(function () {
            Route::match(['get', 'post'], '/departments', 'index')->name('departments_index');
            Route::post('/department_delete', 'delete')->name('department_delete');
            Route::get('/get_department_data/{id}', 'getData')->name('get_department_data');
        });
        Route::controller(TicketController::class)->group(function () {
            Route::match(['get', 'post'], '/tickets', 'index')->name('tickets_index');
        });
        Route::controller(LeaveController::class)->group(function () {
            Route::match(['get', 'post'], '/leaves', 'index')->name('leaves_index');
            Route::get('/get_leave_data/{id}', 'getData')->name('get_leave_data');
        });
        Route::controller(ClaimController::class)->group(function () {
            Route::match(['get', 'post'], '/claims', 'index')->name('claims_index');
            Route::get('/get_claim_data/{id}', 'getData')->name('get_claim_data');
        });
        Route::controller(PayrollController::class)->group(function () {
            Route::get('/payrolls', 'index')->name('payrolls_index');
        });
        Route::controller(ProjectController::class)->group(function () {
            Route::match(['get', 'post'], '/tasks', 'task_index')->name('tasks_index');
            Route::match(['get', 'post'], '/projects', 'project_index')->name('projects_index');
            Route::match(['get', 'post'], '/project_details/{id}', 'project_details')->name('project_details');
            Route::post('/add_attachments/{id}', 'add_attachments')->name('add_attachments');
            Route::get('/get_task_data/{id}', 'getTaskData')->name('get_task_data');
            Route::get('/get_project_data/{id}', 'getProjectData')->name('get_project_data');
            Route::post('/project_delete', 'delete_project')->name('project_delete');
            Route::post('/task_delete', 'delete_task')->name('task_delete');
        });
        Route::controller(AnnouncementController::class)->group(function () {
            Route::match(['get', 'post'], '/announcements', 'index')->name('announcements_index');
            Route::post('/update_announcement', 'update')->name('update_announcement');
            Route::get('/get_announcement_data/{id}', 'getData')->name('get_announcement_data');
            Route::post('/announcement_delete', 'delete')->name('announcement_delete');
        });
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('/employees', 'index')->name('employees_index');
            Route::get('/employee_detail/{id?}', 'detail')->name('employee_detail');
            Route::get('/get_user_data/{id}', 'getData')->name('get_user_data');
            Route::match(['get', 'post'], '/add_employee', 'add')->name('add_employee');
            Route::match(['get', 'post'], '/update_employee/{id}', 'update')->name('update_employee');
            Route::post('/update_attitude_punctuality', 'update_attitude_punctuality')->name('update_attitude_punctuality');
        });
    });

});
