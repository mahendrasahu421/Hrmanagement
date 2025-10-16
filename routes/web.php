<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\EmployeeCotroller;
use App\Http\Controllers\Admin\Clients\ClientsController;
use App\Http\Controllers\Hr\HumanResourceController;
use App\Http\Controllers\Hr\EmployeeController;
use App\Http\Controllers\Hr\JobsController;
use App\Http\Controllers\Hr\JobCategoryController;
use App\Http\Controllers\Hr\HrEmployeeController;
use App\Http\Controllers\Hr\hrEmployeeLeaveController;
use App\Http\Controllers\Hr\LeaveSettingController;
use App\Http\Controllers\Hr\HolidayController;
use App\Http\Controllers\Hr\AttendanceController;
use App\Http\Controllers\Hr\PerformanceController;
use App\Http\Controllers\Hr\PerformanceReviewController;
use App\Http\Controllers\Hr\PerformanceAppraisalController;
use App\Http\Controllers\Hr\GoalTrackingController;
use App\Http\Controllers\Hr\TraningController;
use App\Http\Controllers\Hr\TrainersController;
use App\Http\Controllers\Hr\TraningTypeController;
use App\Http\Controllers\Hr\MasterController;
use App\Http\Controllers\StateCityController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Employee\leavesCotroller;
use App\Http\Controllers\Employee\AttendanceCotroller;
use App\Http\Controllers\Employee\PerformanceCotroller;
use App\Http\Controllers\Employee\PerformanceReviewCotroller;
use App\Http\Controllers\Employee\PayslipCotroller;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MapRolePermission;


Route::get('/districts/search', [StateCityController::class, 'search'])->name('districts.search');
Route::get('/skills/search', [SkillsController::class, 'skillsSearch'])->name('skills.search');



Route::prefix('hr')->name('hr.')->group(function () {
    // HR Dashboard
    Route::get('/dashboard', [HumanResourceController::class, 'index'])->name('dashboard.index');
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

    Route::get('leave', [HrEmployeeLeaveController::class, 'index'])->name('leave.index');

    Route::get('employee/holyday', [HolidayController::class, 'index'])->name('holidays');

    Route::get('employee/leave', [HrEmployeeLeaveController::class, 'index'])->name('leave.index');

    Route::get('employee/leave/setting', [LeaveSettingController::class, 'index'])->name('leave.settings');

    Route::get('employee/attendance', [AttendanceController::class, 'index'])->name('attendance');

    Route::get('employee/performance-indicator', [PerformanceController::class, 'index'])->name('performance.indicator');
    Route::get('employee/performance-review', [PerformanceReviewController::class, 'index'])->name('performance.review');
    Route::get('employee/performance-appraisal', [PerformanceAppraisalController::class, 'index'])->name('performance.appraisal');

    Route::get('employee/goal-tracking', [GoalTrackingController::class, 'index'])->name('goal.tracking');
    Route::get('employee/goal-type', [GoalTrackingController::class, 'goalType'])->name('goal.type');

    Route::get('employee/training', [TraningController::class, 'index'])->name('training');
    Route::get('employee/trainers', [TrainersController::class, 'index'])->name('trainers');
    Route::get('employee/training-type', [TraningTypeController::class, 'index'])->name('training.type');


    Route::get('employee/company', [MasterController::class, 'index'])->name('masters.company');

    Route::get('employee/branch', [MasterController::class, 'branch'])->name('masters.branch');

    Route::get('employee/department', [MasterController::class, 'department'])->name('masters.department');

    Route::get('employee/designation', [MasterController::class, 'designation'])->name('masters.designation');

    Route::get('employee/employee', [MasterController::class, 'employee'])->name('masters.employee');

    Route::get('employee/shift', [MasterController::class, 'shift'])->name('masters.shift');

    Route::get('employee/leavetype', [MasterController::class, 'leavetype'])->name('masters.leavetype');

    Route::get('employee/holiday', [MasterController::class, 'holiday'])->name('masters.holiday');

    Route::get('employee/policyhr', [MasterController::class, 'policyhr'])->name('masters.policyhr');
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
    Route::get('dashboard', [AdminController::class, 'index']);
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



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard.index');
    // Menus
    Route::get('menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('store', [MenuController::class, 'store'])->name('menus.store');
    Route::get('edit', [MenuController::class, 'index'])->name('menus.edit');
    Route::get('destroy', [MenuController::class, 'index'])->name('menus.destroy');
    // map-role-permission
    Route::get('map-role-permission', [MapRolePermission::class, 'index'])->name('map-role-permission.index');
    Route::post('map-role-permission', [MapRolePermission::class, 'store'])->name('map-role-permission.store');
   

    // Resource Controllers (CRUD automatically handled)
    Route::resource('permissions', PermissionController::class, ['as' => 'admin']);

    Route::resource('clients', ClientsController::class, ['as' => 'admin']);
    Route::resource('branches', BranchController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('employee', EmployeeController::class, ['as' => 'admin']);

});
