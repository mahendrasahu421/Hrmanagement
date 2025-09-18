<?php

use App\Http\Controllers\Admin\BranchController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\EmployeeCotroller;
use App\Http\Controllers\Admin\Clients\ClientsController;
use App\Http\Controllers\Hr\HumanResourceController;
use App\Http\Controllers\Hr\EmployeeController;
use App\Http\Controllers\Hr\JobsController;
use App\Http\Controllers\HR\JobCategoryController;
use App\Http\Controllers\HR\HrEmployeeController;
use App\Http\Controllers\HR\HrEmployeeLeaveController;
use App\Http\Controllers\HR\LeaveSettingController;
use App\Http\Controllers\HR\HolidayController;
use App\Http\Controllers\HR\AttendanceController;
use App\Http\Controllers\HR\PerformanceController;
use App\Http\Controllers\HR\PerformanceReviewController;
use App\Http\Controllers\HR\PerformanceAppraisalController;
use App\Http\Controllers\HR\GoalTrackingController;
use App\Http\Controllers\HR\TraningController;
use App\Http\Controllers\HR\TrainersController;
use App\Http\Controllers\HR\TraningTypeController;
use App\Http\Controllers\StateCityController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Employee\leavesCotroller;
use App\Http\Controllers\Employee\AttendanceCotroller;
use App\Http\Controllers\Employee\PerformanceCotroller;
use App\Http\Controllers\Employee\PerformanceReviewCotroller;
use App\Http\Controllers\Employee\PayslipCotroller;


Route::get('/districts/search', [StateCityController::class, 'search'])->name('districts.search');
Route::get('/skills/search', [SkillsController::class, 'skillsSearch'])->name('skills.search');



Route::prefix('hr')->name('hr.')->group(function () {
    // HR Dashboard
    Route::get('/dashboard', [HumanResourceController::class, 'index'])->name('dashboard');
    // Job Categories
    Route::resource('categories', JobCategoryController::class);
    // Jobs
    Route::get('jobs', [JobsController::class, 'index'])->name('jobs.index');
    Route::get('jobs/create', [JobsController::class, 'create'])->name('jobs.create');
    Route::post('jobs/store', [JobsController::class, 'store'])->name('jobs.store');
    Route::get('jobs/list', [JobsController::class, 'list'])->name('jobs.list');

    // Employee
    Route::get('employee', [HrEmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/employee-details', [HrEmployeeController::class, 'employee_details'])->name('employee-details');
    Route::get('employee/departments', [HrEmployeeController::class, 'departments'])->name('employee.departments');
    Route::get('employee/designations', [HrEmployeeController::class, 'designations'])->name('employee.designations');
    Route::get('employee/policy', [HrEmployeeController::class, 'policy'])->name('employee.policy');
    Route::get('employee/leave', [HrEmployeeLeaveController::class, 'index'])->name('leave.index');
    Route::get('employee/holyday', [HolidayController::class, 'index'])->name('holidays.index');
    Route::get('employee/leave', [HrEmployeeLeaveController::class, 'index'])->name('leave.index');
    Route::get('employee/leave/setting', [LeaveSettingController::class, 'index'])->name('leave.setting.index');
    Route::get('employee/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('employee/performance-indicator', [PerformanceController::class, 'index'])->name('performance-indicator.index');
    Route::get('employee/performance-review', [PerformanceReviewController::class, 'index'])->name('performance-review.index');
    Route::get('employee/performance-appraisal', [PerformanceAppraisalController::class, 'index'])->name('performance-appraisal.index');
    Route::get('employee/goal-tracking', [GoalTrackingController::class, 'index'])->name('goal-tracking.index');
    Route::get('employee/goal-type', [GoalTrackingController::class, 'goalType'])->name('goal-type.goal-type');
    Route::get('employee/training', [TraningController::class, 'index'])->name('training.index');
    Route::get('employee/trainers', [TrainersController::class, 'index'])->name('trainers.index');
    Route::get('employee/training-type', [TraningTypeController::class, 'index'])->name('training-type.index');
});


Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




// Employee
Route::prefix('employee')->middleware('auth')->group(function () {
    Route::get('dashboard', [EmployeeCotroller::class, 'index']);
    Route::get('leaves', [leavesCotroller::class, 'index']);
    Route::get('attendance', [AttendanceCotroller::class, 'index']);
    Route::get('performance', [PerformanceCotroller::class, 'index']);
    Route::get('performance/review', [PerformanceReviewCotroller::class, 'index']);
    Route::get('payslip', [PayslipCotroller::class, 'index']);

});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Permission
    Route::get('permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permissions/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::get('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('roles/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Clients
    Route::get('clients', [ClientsController::class, 'index'])->name('admin.clients');
    Route::post('clients/create', [ClientsController::class, 'create'])->name('admin.clients.create');
    Route::get('clients/{id}/client-details', [ClientsController::class, 'show'])->name('admin.clients.details');

    // Branch
    Route::get('branch', [BranchController::class, 'index'])->name('admin.branch');
    // Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee');
});

