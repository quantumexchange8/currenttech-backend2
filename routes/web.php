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
});

Route::get("localization/{lange}", [LocalizationController::class, "setLang"]);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot_password');
    });
    Route::get('/reset-password', function () {
        return view('auth.reset_password');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function() {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });
    Route::controller(AdminController::class)->group(function () {
        Route::get('/subadmin', 'index')->name('admin_index');
    });
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index')->name('departments_index');
    });
    Route::controller(TicketController::class)->group(function () {
        Route::get('/tickets', 'index')->name('tickets_index');
    });
    Route::controller(LeaveController::class)->group(function () {
        Route::get('/leaves', 'index')->name('leaves_index');
    });
    Route::controller(ClaimController::class)->group(function () {
        Route::get('/claims', 'index')->name('claims_index');
    });
    Route::controller(PayrollController::class)->group(function () {
        Route::get('/payrolls', 'index')->name('payrolls_index');
    });
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/tasks', 'task_index')->name('tasks_index');
        Route::get('/projects', 'project_index')->name('projects_index');
        Route::get('/project_details/{id}', 'project_details')->name('project_details');
    });
    Route::controller(AnnouncementController::class)->group(function () {
        Route::get('/announcements', 'index')->name('announcements_index');
    });
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index')->name('employees_index');
        Route::get('/employee_detail', 'detail')->name('employee_detail');
        Route::get('/add_employee', 'add')->name('add_employee');
    });
});
