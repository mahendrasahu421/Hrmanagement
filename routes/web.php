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
use App\Http\Controllers\StateCityController;
use App\Http\Controllers\SkillsController;

Route::get('/districts/search', [StateCityController::class, 'search'])->name('districts.search');
Route::get('/skills/search', [SkillsController::class, 'skillsSearch'])->name('skills.search');

Route::prefix('hr')->name('hr.')->group(function () {
    Route::get('/dashboard', function () {
        return view('hr.dashboard');
    })->name('dashboard');

    // Category ke liye resource route
    Route::resource('categories', JobCategoryController::class);
    Route::resource('jobs', JobsController::class);

});
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/hr/dashboard', [HumanResourceController::class, 'index'])->name('hr.dashboard');

Route::get('/hr/employee', [EmployeeController::class, 'index'])->name('hr.employee');
Route::get('/hr/jobs', [JobsController::class, 'index'])->name('hr.jobs');
Route::get('/hr/jobs/categories', [JobsController::class, 'index'])->name('hr.jobs.categories');



Route::get('/employee/dashboard', [EmployeeCotroller::class, 'index']);


Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Clients
    Route::get('clients', [ClientsController::class, 'index'])->name('admin.clients');
    Route::post('clients/create', [ClientsController::class, 'create'])->name('admin.clients.create');
    Route::get('clients/{id}/client-details', [ClientsController::class, 'show'])->name('admin.clients.details');

    // Branch
    Route::get('branch', [BranchController::class, 'index'])->name('admin.branch');
});
