<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\EmployeeCotroller;
use App\Http\Controllers\Admin\Clients\ClientsController;
use App\Http\Controllers\Hr\HumanResourceController;
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
use App\Http\Controllers\Masters\CategoryController;
use App\Http\Controllers\Masters\SalaryComponentController;
use App\Http\Controllers\Masters\SalaryStructureController;
use App\Http\Controllers\Masters\CalculationRulesController;
use App\Http\Controllers\Masters\TaxationController;
use App\Http\Controllers\Masters\ApplicabilityController;
use App\Http\Controllers\Masters\PaymentFrequencyController;
use App\Http\Controllers\Masters\PaymentModeController;
use App\Http\Controllers\Masters\VisibilityControlController;
use App\Http\Controllers\Masters\AdminEmployeeController;
use App\Http\Controllers\Masters\JobsController;
use App\Http\Controllers\Attendance\AttendanceDashboardController;
use App\Http\Controllers\Attendance\AttendanceOrgReportController;
use App\Http\Controllers\Attendance\ConsistentAttendeesController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Hr\JobsController as HrJobsController;
use App\Http\Controllers\Masters\JafController;
use App\Http\Controllers\Masters\LeaveMappingController;
use App\Http\Controllers\Masters\JobsController as MastersJobsController;
use App\Http\Controllers\Masters\JobSkillController;
use App\Http\Controllers\Masters\OnboardingController;
use App\Http\Controllers\PMT\FeedbackController;
use App\Http\Controllers\PMT\ReviewEmployeeController;
use App\Http\Controllers\PMT\SelfAppraisalController;
use App\Http\Controllers\PMT\ViewFeedbackController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ResumeController;


Route::get('/districts/search', [StateCityController::class, 'search'])->name('districts.search');
Route::get('/skills/search', [SkillsController::class, 'skillsSearch'])->name('skills.search');

Route::post('/parse-resume', [ResumeController::class, 'parse'])
    ->name('resume.parse');



Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/get-departments/{category_id}', [DashboardController::class, 'getDepartments']);
    Route::get('/get-designation/{department_id}', [DashboardController::class, 'getDesignation']);
    Route::get('/get-state/{country_id}', [DashboardController::class, 'getStates'])->name('getStates');
    Route::get('/get-cities/{state_id}', [DashboardController::class, 'getCities'])->name('getCities');
    Route::get('/leave-type/get-days/{id}', [LeaveMappingController::class, 'getDays']);


    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    // HR Dashboard
    Route::get('/dashboard', [HumanResourceController::class, 'index'])->name('dashboard');
    // Job Categories
    Route::resource('categories', JobCategoryController::class);
    // Jobs
    // Route::get('jobs', [JobsController::class, 'index'])->name('jobs.index');
    // Route::get('jobs/create', [JobsController::class, 'create'])->name('jobs.create');
    // Route::post('jobs/store', [JobsController::class, 'store'])->name('jobs.store');
    // Route::get('jobs/list', [JobsController::class, 'list'])->name('jobs.list');

    // Master/Organisation/Compney
    Route::get('masters/organisation/company', [CompanyController::class, 'index'])->name('masters.organisation.company');
    Route::get('masters/organisation/company/create', [CompanyController::class, 'create'])->name('masters.organisation.company.create');
    Route::post('masters/organisation/company/store', [CompanyController::class, 'store'])->name('masters.organisation.company.store');
    Route::get('masters/organisation/company/list', [CompanyController::class, 'list'])->name('masters.organisation.company.list');
    Route::get('masters/organisation/company/edit', [CompanyController::class, 'edit'])->name('masters.organisation.company.edit');

    // Master/Organisation/Branch
    Route::get('masters/organisation/branch', [BranchController::class, 'index'])->name('masters.organisation.branch');
    Route::get('masters/organisation/branch/create', [BranchController::class, 'create'])->name('masters.organisation.branch.create');
    Route::post('masters/organisation/branch/store', [BranchController::class, 'store'])->name('masters.organisation.branch.store');
    Route::get('masters/organisation/branch/list', [BranchController::class, 'list'])->name('masters.organisation.branch.list');
    Route::get('masters/organisation/branch/edit', [BranchController::class, 'edit'])->name('masters.organisation.branch.edit');



    // Master/Organisation/Department
    Route::get('settings/department', [DepartmentController::class, 'index'])->name('settings.department');
    Route::get('settings/department/create', [DepartmentController::class, 'create'])->name('settings.department.create');
    Route::post('settings/department/store', [DepartmentController::class, 'store'])->name('settings.department.store');
    Route::get('settings/department/edit/{id}', [DepartmentController::class, 'edit'])->name('settings.department.edit');
    Route::put('settings/department/edit/{id}', [DepartmentController::class, 'update'])->name('settings.department.update');
    Route::delete('settings/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('settings.department.destroy');
    Route::get('settings/department/list', [DepartmentController::class, 'list'])->name('settings.department.list');

    // Master/Organisation/Designation
    Route::get('settings/designation', [DesignationController::class, 'index'])->name('settings.designation');
    Route::get('settings/designation/create', [DesignationController::class, 'create'])->name('settings.designation.create');
    Route::post('settings/designation/store', [DesignationController::class, 'store'])->name('settings.designation.store');
    Route::get('settings/designation/edit/{id}', [DesignationController::class, 'edit'])->name('settings.designation.edit');
    Route::put('settings/designation/edit/{id}', [DesignationController::class, 'update'])->name('settings.designation.update');
    Route::delete('settings/designation/delete/{id}', [DesignationController::class, 'destroy'])->name('settings.designation.destroy');
    Route::get('settings/designation/list', [DesignationController::class, 'list'])->name('settings.designation.list');

    // Master/Organisation/Shift
    Route::get('settings/shift', [ShiftController::class, 'index'])->name('settings.shift');
    Route::get('settings/shift/create', [ShiftController::class, 'create'])->name('settings.shift.create');
    Route::post('settings/shift/store', [ShiftController::class, 'store'])->name('settings.shift.store');
    Route::get('settings/shift/edit/{id}', [ShiftController::class, 'edit'])->name('settings.shift.edit');
    Route::put('settings/shift/edit/{id}', [ShiftController::class, 'update'])->name('settings.shift.update');
    Route::delete('settings/shift/delete/{id}', [ShiftController::class, 'destroy'])->name('settings.shift.destroy');
    Route::get('settings/shift/list', [ShiftController::class, 'list'])->name('settings.shift.list');

    // Master/Organisation/Leave Type
    Route::get('settings/leave-type', [LeaveTypeController::class, 'index'])->name('settings.leave-type');
    Route::get('settings/leave-type/create', [LeaveTypeController::class, 'create'])->name('settings.leave-type.create');
    Route::post('settings/leave-type/store', [LeaveTypeController::class, 'store'])->name('settings.leave-type.store');
    Route::get('settings/leave-type/edit/{id}', [LeaveTypeController::class, 'edit'])->name('settings.leave-type.edit');
    Route::put('settings/leave-type/edit/{id}', [LeaveTypeController::class, 'update'])->name('settings.leave-type.update');
    Route::delete('settings/leave-type/delete/{id}', [LeaveTypeController::class, 'destroy'])->name('settings.leave-type.destroy');
    Route::get('settings/leave-type/list', [LeaveTypeController::class, 'list'])->name('settings.leave-type.list');
    // Master/Organisation/Leave Allow
    Route::get('settings/leave-allow', [LeaveMappingController::class, 'index'])->name('settings.leave-allow');
    Route::get('settings/leave-allow/create', [LeaveMappingController::class, 'create'])->name('settings.leave-allow.create');
    Route::post('settings/leave-mapping/store', [LeaveMappingController::class, 'store'])->name('settings.leave.mapping.store');

    // Route::post('settings/leave-type/store', [LeaveTypeController::class, 'store'])->name('settings.leave-type.store');
    // Route::get('settings/leave-type/edit/{id}', [LeaveTypeController::class, 'edit'])->name('settings.leave-type.edit');
    // Route::put('settings/leave-type/edit/{id}', [LeaveTypeController::class, 'update'])->name('settings.leave-type.update');
    // Route::delete('settings/leave-type/delete/{id}', [LeaveTypeController::class, 'destroy'])->name('settings.leave-type.destroy');
    // Route::get('settings/leave-type/list', [LeaveTypeController::class, 'list'])->name('settings.leave-type.list');

    // Master/Organisation/Holiday
    Route::get('settings/holiday', [HolidayController::class, 'index'])->name('settings.holiday');
    Route::get('settings/holiday/create', [HolidayController::class, 'create'])->name('settings.holiday.create');
    Route::get('settings/holiday/store', [HolidayController::class, 'store'])->name('settings.holiday.store');

    // Master/Organisation/Policy
    Route::get('masters/organisation/policy', [PolicyController::class, 'index'])->name('masters.organisation.policy');
    Route::get('masters/organisation/policy/create', [PolicyController::class, 'create'])->name('masters.organisation.policy.create');
    Route::get('masters/organisation/policy/store', [PolicyController::class, 'store'])->name('masters.organisation.policy.store');

    // Master/Recruitment/Jobs

    Route::get('recruitment/jobs', [JobsController::class, 'index'])->name('recruitment.jobs');
    Route::get('recruitment/job/applied-candidate', [JobsController::class, 'appliedCandidate'])->name('recruitment.jobs.applied-candidate');
    Route::get('recruitment/jobs/applied-candidate/ajax', [JobsController::class, 'appliedCandfidateAjax'])->name('jobs.applied.ajax');
    Route::get('employee/details/{id}', [JobsController::class, 'employeeDetails'])->name('employee.details');
    Route::get('recruitment/jobs/create', [JobsController::class, 'create'])->name('recruitment.jobs.create');
    Route::post('recruitment/jobs/store', [JobsController::class, 'store'])->name('recruitment.jobs.store');
    Route::get('recruitment/jobs/list', [JobsController::class, 'list'])->name('recruitment.jobs.list');
    Route::get('recruitment/jobs/recommended-job', [JobsController::class, 'recommendedJob'])->name('recruitment.jobs.recommended-job');
    Route::get('recruitment/jobs/job-listings/{slug}',[JobsController::class, 'jobDetails'])->name('recruitment.jobs.job-deatils');




    Route::get('recruitment/jobs/job-apply-form', [JobsController::class, 'jobForm'])->name('recruitment.jobs.apply.form');

    // Employee/Onboarding
    Route::get('employee/onboarding', [OnboardingController::class, 'index'])->name('employee.onboarding');

    Route::get('recruitment/jobs/create-job-questionaire', [JafController::class, 'index'])->name('create-job-questionaire');
    Route::post('recruitment/jobs/create-job-questionaire/store', [JafController::class, 'store'])->name('jaf.store');
    Route::get('recruitment/jobs/create-job-questionaire/show', [JafController::class, 'show'])->name('jaf.index');

    // Master/Payroll/salary-component
    Route::get('masters/payroll/salary-component', [SalaryComponentController::class, 'index'])->name('masters.payroll.salary-component');
    Route::get('masters/payroll/salary-component/create', [SalaryComponentController::class, 'create'])->name('masters.payroll.salary-component.create');
    Route::post('masters/payroll/salary-component/store', [SalaryComponentController::class, 'store'])->name('masters.payroll.salary-component.store');

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
    Route::get('employee', [AdminEmployeeController::class, 'index'])->name('employee');
    Route::get('employee/create', [AdminEmployeeController::class, 'create'])->name('employee.create');
    Route::get('employee/store', [AdminEmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/list', [AdminEmployeeController::class, 'list'])->name('employee.list');


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

    Route::get('masters/user-management/permissions', [PermissionController::class, 'index'])->name('permission');
    Route::get('masters/user-management/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('masters/user-management/permissions/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('masters/user-management/permissions/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::get('masters/user-management/permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    // Roles
    Route::get('masters/user-management/roles', [RoleController::class, 'index'])->name('role');
    Route::get('masters/user-management/roles/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('masters/user-management/roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('masters/user-management/roles/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('masters/user-management/roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // map-role-permission
    Route::get('map-role-permission', [MapRolePermission::class, 'index'])->name('map-role-permission');
    Route::get('map-role-permission/store', [MapRolePermission::class, 'index'])->name('map-role-permission.store');

    Route::get('settings/email-template', [SettingController::class, 'index'])->name('settings.email-templates');
    Route::get('settings/email-template/create', [SettingController::class, 'create'])->name('settings.email-templates.create');
    Route::post('settings/email-template/store', [SettingController::class, 'store'])->name('settings.email-template.store');
    Route::get('settings/email-template/list', [SettingController::class, 'list'])->name('settings.email-template.list');
    Route::get('settings/email-template/preview/{id}', [SettingController::class, 'preview'])->name('settings.email-template.preview');

    // Master/Organisation/JobSkill
    Route::get('settings/jobskill', [JobSkillController::class, 'index'])->name('settings.jobskill');
    Route::get('settings/jobskill/list', [JobSkillController::class, 'list'])->name('settings.jobskill.list');
    Route::get('settings/jobskill/create', [JobSkillController::class, 'create'])->name('settings.jobskill.create');
    Route::post('settings/jobskill/store', [JobSkillController::class, 'store'])->name('settings.jobskill.store');
    Route::get('settings/jobskill/edit/{id}', [JobSkillController::class, 'edit'])->name('settings.jobskill.edit');
    Route::put('settings/jobskill/update/{id}', [JobSkillController::class, 'update'])->name('settings.jobskill.update');
    Route::delete('settings/jobskill/delete/{id}', [JobSkillController::class, 'destroy']);


    // Master/Organisation/Category
    Route::get('settings/category', [CategoryController::class, 'index'])->name('settings.category');
    Route::get('settings/category/create', [CategoryController::class, 'create'])->name('settings.category.create');
    Route::post('settings/category/store', [CategoryController::class, 'store'])->name('settings.category.store');
    Route::get('settings/category/edit/{id}', [CategoryController::class, 'edit'])->name('settings.category.edit');
    Route::put('settings/category/edit/{id}', [CategoryController::class, 'update'])->name('settings.category.update');
    Route::delete('settings/category/delete/{id}', [CategoryController::class, 'destroy'])->name('settings.category.destroy');
    Route::get('settings/category/list', [CategoryController::class, 'list'])->name('settings.category.list');

    Route::get('attendance/leave/request', [AttendanceController::class, 'index'])->name('attendance.leave.request');
    Route::get('attendance/leave/list', [AttendanceController::class, 'list'])->name('leaves.list');
    Route::post('attendance/leave/updateStatus', [AttendanceController::class, 'updateStatus'])->name('leave.updateStatus');
});


Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// // Employee
Route::get('/employee/login', [EmployeeAuthController::class, 'index'])->name('employee.login');
Route::post('/employee/login', [EmployeeAuthController::class, 'store'])->name('employee.login');
Route::get('/employee/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
Route::prefix('employee')->middleware('auth:employee')->group(function () {

    // Self Appraisal
    Route::prefix('self-appraisal')->group(function () {

        Route::get('/', [SelfAppraisalController::class, 'index'])->name('employee.self.appraisal');
        Route::get('/competencies', [SelfAppraisalController::class, 'competencies'])->name('employee.competencies');
        Route::get('/kpi-assessment', [SelfAppraisalController::class, 'kpiAssessment'])->name('employee.kpi.assessment');
        Route::get('/form-c', [SelfAppraisalController::class, 'formC'])->name('employee.form-c');
    });

    // Review your Employee

    Route::prefix('review-employee')->group(function () {
        Route::get('/', [ReviewEmployeeController::class, 'index'])->name('employee.review.employee');
    });


    Route::get('/feedback', [FeedbackController::class, 'index'])->name('employee.feedback');
    Route::get('/view-feedback', [ViewFeedbackController::class, 'index'])->name('employee.view-feedback');

    // Dashboard
    Route::get('dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('dashboard/data', [EmployeeController::class, 'dashboardData'])->name('employee.dashboard.data');

    // Leaves
    Route::get('leaves', [LeavesController::class, 'index'])->name('employee.leaves');
    Route::get('leaves/apply', [LeavesController::class, 'create'])->name('employee.leaves.apply');
    Route::post('leaves/apply/store', [LeavesController::class, 'store'])->name('employee.leaves.store');
    Route::get('leaves/list', [LeavesController::class, 'list'])->name('employee.leaves.list');
    Route::get('leave/balance/{leaveTypeId}', [LeavesController::class, 'getLeaveBalance'])->name('leave.balance');

    // Attendance & Holidayssettings
    Route::get('attendance', [AttendanceController::class, 'show'])->name('employee.attendance');
    Route::get('holidays', [AttendanceController::class, 'holidayList'])->name('employee.holidays');

    // Performance
    Route::get('performance', [PerformanceController::class, 'index'])->name('employee.performance');
    Route::get('performance/review', [PerformanceReviewController::class, 'index'])->name('employee.performance.review');

    // Payslip
    // Route::get('payslip', [PayslipController::class, 'index'])->name('employee.payslip');
    Route::get('/checkin-app', [CheckinController::class, 'index']);
    Route::post('/checkin', [CheckinController::class, 'checkin']);
    Route::post('/checkout', [CheckinController::class, 'checkout']);
});
