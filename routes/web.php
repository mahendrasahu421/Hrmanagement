<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\EmployeeCotroller;
use App\Http\Controllers\Admin\Clients\ClientsController;
use App\Http\Controllers\Hr\HumanResourceController;
use App\Http\Controllers\Hr\JobsController;
use App\Http\Controllers\Hr\JobCategoryController;
use App\Http\Controllers\Hr\hrEmployeeController;
use App\Http\Controllers\Hr\hrEmployeeLeaveController;
use App\Http\Controllers\Hr\LeaveSettingController;
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
use App\Http\Controllers\MapRolePermission;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Employee\leavesController;
use App\Http\Controllers\Employee\AttendanceCotroller;
use App\Http\Controllers\Employee\PerformanceCotroller;
use App\Http\Controllers\Employee\PerformanceReviewCotroller;
use App\Http\Controllers\Employee\PayslipCotroller;
use App\Http\Controllers\AdminHR\DashboardController;
use App\Http\Controllers\Masters\CompanyController;
use App\Http\Controllers\Masters\BranchController;
use App\Http\Controllers\Masters\DepartmentController;
use App\Http\Controllers\Masters\DesignationController;
use App\Http\Controllers\Masters\ShiftController;
use App\Http\Controllers\Masters\LeaveTypeController;
use App\Http\Controllers\Masters\HolidayController;
use App\Http\Controllers\Masters\PolicyController;
use App\Http\Controllers\Masters\SalaryComponentController;
use App\Http\Controllers\Masters\SalaryStructureController;
use App\Http\Controllers\Masters\CalculationRulesController;
use App\Http\Controllers\Masters\TaxationController;
use App\Http\Controllers\Masters\ApplicabilityController;
use App\Http\Controllers\Masters\PaymentFrequencyController;
use App\Http\Controllers\Masters\PaymentModeController;
use App\Http\Controllers\Masters\VisibilityControlController;
use App\Http\Controllers\Masters\EmployeeController;
use App\Http\Controllers\Attendance\AttendanceDashboardController;
use App\Http\Controllers\Attendance\AttendanceOrgReportController;
use App\Http\Controllers\Attendance\ConsistentAttendeesController;


Route::get('/districts/search', [StateCityController::class, 'search'])->name('districts.search');
Route::get('/skills/search', [SkillsController::class, 'skillsSearch'])->name('skills.search');



Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    // HR Dashboard
    Route::get('/dashboard', [HumanResourceController::class, 'index'])->name('dashboard');
    // Job Categories
    Route::resource('categories', JobCategoryController::class);
    // Jobs
    Route::get('jobs', [JobsController::class, 'index'])->name('jobs.index');
    Route::get('jobs/create', [JobsController::class, 'create'])->name('jobs.create');
    Route::post('jobs/store', [JobsController::class, 'store'])->name('jobs.store');
    Route::get('jobs/list', [JobsController::class, 'list'])->name('jobs.list');

    // Master/Organisation/Compney
    Route::get('masters/organisation/company', [CompanyController::class, 'index'])->name('masters.organisation.company');
    Route::get('masters/organisation/company/create', [CompanyController::class, 'create'])->name('masters.organisation.company.create');
    Route::get('masters/organisation/company/store', [CompanyController::class, 'create'])->name('masters.organisation.company.store');

    // Master/Organisation/Branch
    Route::get('masters/organisation/branch', [BranchController::class, 'index'])->name('masters.organisation.branch');
    Route::get('masters/organisation/branch/create', [BranchController::class, 'create'])->name('masters.organisation.branch.create');
    Route::get('masters/organisation/branch/store', [BranchController::class, 'create'])->name('masters.organisation.branch.store');

    // Master/Organisation/Department
    Route::get('masters/organisation/department', [DepartmentController::class, 'index'])->name('masters.organisation.department');
    Route::get('masters/organisation/department/create', [DepartmentController::class, 'create'])->name('masters.organisation.department.create');
    Route::post('masters/organisation/department/store', [DepartmentController::class, 'store'])->name('masters.organisation.department.store');
    Route::get('masters/organisation/department/edit/{id}', [DepartmentController::class, 'edit'])->name('masters.organisation.department.edit');
    Route::put('masters/organisation/department/edit/{id}', [DepartmentController::class, 'update'])->name('masters.organisation.department.update');
    Route::delete('masters/organisation/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('masters.organisation.department.destroy');
    Route::get('masters/organisation/department/list', [DepartmentController::class, 'list'])->name('masters.organisation.department.list');

    // Master/Organisation/Designation
    Route::get('masters/organisation/designation', [DesignationController::class, 'index'])->name('masters.organisation.designation');
    Route::get('masters/organisation/designation/create', [DesignationController::class, 'create'])->name('masters.organisation.designation.create');
    Route::post('masters/organisation/designation/store', [DesignationController::class, 'store'])->name('masters.organisation.designation.store');
    Route::get('masters/organisation/designation/edit/{id}', [DesignationController::class, 'edit'])->name('masters.organisation.designation.edit');
    Route::put('masters/organisation/designation/edit/{id}', [DesignationController::class, 'update'])->name('masters.organisation.designation.update');
    Route::delete('masters/organisation/designation/delete/{id}', [DesignationController::class, 'destroy'])->name('masters.organisation.designation.destroy');
    Route::get('masters/organisation/designation/list', [DesignationController::class, 'list'])->name('masters.organisation.designation.list');

    // Master/Organisation/Shift
    Route::get('masters/organisation/shift', [ShiftController::class, 'index'])->name('masters.organisation.shift');
    Route::get('masters/organisation/shift/create', [ShiftController::class, 'create'])->name('masters.organisation.shift.create');
    Route::get('masters/organisation/shift/store', [ShiftController::class, 'store'])->name('masters.organisation.shift.store');

    // Master/Organisation/Leave Type
    Route::get('masters/organisation/leave-type', [LeaveTypeController::class, 'index'])->name('masters.organisation.leave-type');
    Route::get('masters/organisation/leave-type/create', [LeaveTypeController::class, 'create'])->name('masters.organisation.leave-type.create');
    Route::get('masters/organisation/leave-type/store', [LeaveTypeController::class, 'store'])->name('masters.organisation.leave-type.store');

    // Master/Organisation/Holiday
    Route::get('masters/organisation/holiday', [HolidayController::class, 'index'])->name('masters.organisation.holiday');
    Route::get('masters/organisation/holiday/create', [HolidayController::class, 'create'])->name('masters.organisation.holiday.create');
    Route::get('masters/organisation/holiday/store', [HolidayController::class, 'store'])->name('masters.organisation.holiday.store');

    // Master/Organisation/Policy
    Route::get('masters/organisation/policy', [PolicyController::class, 'index'])->name('masters.organisation.policy');
    Route::get('masters/organisation/policy/create', [PolicyController::class, 'create'])->name('masters.organisation.policy.create');
    Route::get('masters/organisation/policy/store', [PolicyController::class, 'store'])->name('masters.organisation.policy.store');

    // Master/Payroll/salary-component
    Route::get('masters/payroll/salary-component', [SalaryComponentController::class, 'index'])->name('masters.payroll.salary-component');
    Route::get('masters/payroll/salary-component/create', [SalaryComponentController::class, 'create'])->name('masters.payroll.salary-component.create');
    Route::get('masters/payroll/salary-component/store', [SalaryComponentController::class, 'store'])->name('masters.payroll.salary-component.store');

    // Master/Payroll/salary-structure
    Route::get('masters/payroll/salary-structure', [SalaryStructureController::class, 'index'])->name('masters.payroll.salary-structure');
    Route::get('masters/payroll/salary-structure/create', [SalaryStructureController::class, 'create'])->name('masters.payroll.salary-structure.create');
    Route::get('masters/payroll/salary-structure/store', [SalaryStructureController::class, 'store'])->name('masters.payroll.salary-structure.store');

    // Master/Payroll/calculation-rules
    Route::get('masters/payroll/calculation-rules', [CalculationRulesController::class, 'index'])->name('masters.payroll.calculation-rules');
    Route::get('masters/payroll/calculation-rules/create', [CalculationRulesController::class, 'create'])->name('masters.payroll.calculation-rules.create');
    Route::get('masters/payroll/calculation-rules/store', [CalculationRulesController::class, 'store'])->name('masters.payroll.calculation-rules.store');

    // Master/Payroll/Taxation
    Route::get('masters/payroll/taxation', [TaxationController::class, 'index'])->name('masters.payroll.taxation');
    Route::get('masters/payroll/taxation/create', [TaxationController::class, 'create'])->name('masters.payroll.taxation.create');
    Route::get('masters/payroll/taxation/store', [TaxationController::class, 'store'])->name('masters.payroll.taxation.store');

    // Master/Payroll/applicability
    Route::get('masters/payroll/applicability', [ApplicabilityController::class, 'index'])->name('masters.payroll.applicability');
    Route::get('masters/payroll/applicability/create', [ApplicabilityController::class, 'create'])->name('masters.payroll.applicability.create');
    Route::get('masters/payroll/applicability/store', [ApplicabilityController::class, 'store'])->name('masters.payroll.applicability.store');

    // Master/Payroll/PaymentFrequency
    Route::get('masters/payroll/frequency', [PaymentFrequencyController::class, 'index'])->name('masters.payroll.payment-frequency');
    Route::get('masters/payroll/frequency/create', [PaymentFrequencyController::class, 'create'])->name('masters.payroll.payment-frequency.create');
    Route::get('masters/payroll/frequency/store', [PaymentFrequencyController::class, 'store'])->name('masters.payroll.payment-frequency.store');

    // Master/Payroll/payment-mode
    Route::get('masters/payroll/payment-mode', [PaymentModeController::class, 'index'])->name('masters.payroll.payment-mode');
    Route::get('masters/payroll/payment-mode/create', [PaymentModeController::class, 'create'])->name('masters.payroll.payment-mode.create');
    Route::get('masters/payroll/payment-mode/store', [PaymentModeController::class, 'store'])->name('masters.payroll.payment-mode.store');


    // Master/Payroll/payment-mode
    Route::get('masters/payroll/visibility', [VisibilityControlController::class, 'index'])->name('masters.payroll.visibility');
    Route::get('masters/payroll/visibility/create', [VisibilityControlController::class, 'create'])->name('masters.payroll.visibility.create');
    Route::get('masters/payroll/visibility/store', [VisibilityControlController::class, 'store'])->name('masters.payroll.visibility.store');


    // Employee
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
    Route::get('employee/store', [EmployeeController::class, 'store'])->name('employee.store');

    // Summary
    Route::get('attendance/attendance-dashboard/summary', [AttendanceDashboardController::class, 'index'])->name('attendance.attendance-dashboard.summary');
    Route::get('attendance/attendance-dashboard/summary/create', [AttendanceDashboardController::class, 'create'])->name('attendance.attendance-dashboard.summary.create');
    Route::get('attendance/attendance-dashboard/summary/store', [AttendanceDashboardController::class, 'store'])->name('attendance.attendance-dashboard.summary.store');

    // Org-Reports
    Route::get('attendance/attendance-dashboard/org-reports', [AttendanceOrgReportController::class, 'index'])->name('attendance.attendance-dashboard.org-reports');
    Route::get('attendance/attendance-dashboard/org-reports/create', [AttendanceOrgReportController::class, 'create'])->name('attendance.attendance-dashboard.org-reports.create');
    Route::get('attendance/attendance-dashboard/org-reports/store', [AttendanceOrgReportController::class, 'store'])->name('attendance.attendance-dashboard.org-reports.store');
    // Org-Reports
    Route::get('attendance/daily-attendance/consistent-attendees', [ConsistentAttendeesController::class, 'index'])->name('attendance.daily-attendance.consistent-attendees');

    Route::get('permissions', [PermissionController::class, 'index'])->name('permission');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permissions/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::get('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('role');
    Route::get('roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('roles/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // map-role-permission
    Route::get('map-role-permission', [MapRolePermission::class, 'index'])->name('map-role-permission');
    Route::get('map-role-permission/store', [MapRolePermission::class, 'index'])->name('map-role-permission.store');
});


Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




// // Employee
Route::prefix('employee')->middleware('auth')->group(function () {
    Route::get('dashboard', [EmployeeCotroller::class, 'index']);
    Route::get('employee/dashboard/data', [EmployeeCotroller::class, 'dashboardData'])->name('employee.dashboard.data');
    Route::get('leaves', [leavesController::class, 'index'])->name('employee.leaves');
    Route::get('leaves/apply', [leavesController::class, 'create'])->name('employee.leaves.apply');
    Route::post('leaves/apply/store', [leavesController::class, 'store'])->name('employee.leaves.store');
    Route::get('employee/leaves/list', [leavesController::class, 'list'])->name('employee.leaves.list');


    Route::get('leaves/list', [AttendanceCotroller::class, 'show']);
    Route::get('holiday/list', [AttendanceCotroller::class, 'holidayList']);
    Route::get('performance', [PerformanceCotroller::class, 'index']);
    Route::get('performance/review', [PerformanceReviewCotroller::class, 'index']);
    Route::get('payslip', [PayslipCotroller::class, 'index']);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Permission
    Route::get('clients', [ClientsController::class, 'index'])->name('admin.clients');
    Route::post('clients/create', [ClientsController::class, 'create'])->name('admin.clients.create');
    Route::get('clients/{id}/client-details', [ClientsController::class, 'show'])->name('admin.clients.details');

    // Branch
    Route::get('branch', [BranchController::class, 'index'])->name('admin.branch');
    // Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee');
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
