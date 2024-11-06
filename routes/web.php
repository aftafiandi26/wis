<?php

use App\Http\Controllers\ApplyingLeave\AnnualeaveController;
use App\Http\Controllers\ApplyingLeave\AnnualEOCLeaveController;
use App\Http\Controllers\ApplyingLeave\ApplyingDashboardController;
use App\Http\Controllers\ApplyingLeave\CustomApplyingLeaveController;
use App\Http\Controllers\ApplyingLeave\DatatablesApplyingLeaveController;
use App\Http\Controllers\ApplyingLeave\ExdoleaveController;
use App\Http\Controllers\HRD\Annual\AnnualController;
use App\Http\Controllers\HRD\Datatables\AnnualeaveDatatablesController;
use App\Http\Controllers\HRD\Datatables\EmployeeLeaveDatatablesController;
use App\Http\Controllers\HRD\Datatables\EmployesDatatables;
use App\Http\Controllers\HRD\EmployeeLeave\EmployeeLeaveDashboardController;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Http\Controllers\HRD\Employes\EmpoyesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Super_Administrator\Management_Role\RoleAccessController;
use App\Http\Controllers\Super_Administrator\Management_Role\RoleDatatablesController;
use App\Http\Controllers\Super_Administrator\Management_Role\RoleEntitlementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "hallo";
});

Route::get('/dashboard', function () {
    return view('template_admin');
})->middleware(['auth', 'active'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('hrd')->middleware(['auth', 'active'])->group(function () {
    Route::get('employes/data', [EmployesDatatables::class, 'data'])->name('employes.data');
    Route::get('employes/deactiveData', [EmployesDatatables::class, 'deactiveData'])->name('employes.deactiveData');
    Route::get('employes/endofContract', [EmployesDatatables::class, 'endofContract'])->name('employes.endofContract');

    Route::get('employes/annualeave/data', [AnnualeaveDatatablesController::class, 'dataAnnualofEmployes'])->name('employes.annualeave.data');

    Route::get('employes/actived', [CustomEmployesController::class, 'activeEmployes'])->name('employes.actived');
    Route::get('employes/annual/{id}', [CustomEmployesController::class, 'annualInput'])->name('employes.annual');
    Route::post('employes/annual/post/{id}', [CustomEmployesController::class, 'postAnnualInput'])->name('employes.annual.post');

    // Route::resource('employes/annualeave', AnnualController::class)->only(['index', 'show', 'edit']);

    Route::resource('employes', EmpoyesController::class);

    Route::get('emplyoee-leave/annual/data', [EmployeeLeaveDatatablesController::class, 'dataAnnualofEmployes'])->name('employee-leave.annual.data');
    Route::resource('employee-leave-dashboard', EmployeeLeaveDashboardController::class)->only('index', 'show');
});

Route::prefix('super-admin')->middleware(['auth', 'active'])->group(function () {

    Route::get('management-role-access/data', [RoleDatatablesController::class, 'ROleAccess'])->name('management-role-access.data');
    Route::resource('management-role-access', RoleAccessController::class)->only(['index', 'show', 'update', 'store']);

    Route::get('management-role-entitlement/data', [RoleDatatablesController::class, 'RoleEntitlement'])->name('management-role-entitlement.data');
    Route::resource('management-role-entitlement', RoleEntitlementController::class)->except(['destroy', 'create', 'edit']);
});

// menu umum

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('applying-leave-annual-regency/{id}', [CustomApplyingLeaveController::class, 'getRegency'])->name('applying-leave-annual-regency');
    Route::get('applying-leave-annual-show-delete/{id}', [CustomApplyingLeaveController::class, 'modalProgressShowDelete'])->name('applying-leave-annual-modal.delete');
    Route::resource('applying-leave-annual', AnnualeaveController::class)->except(['index']);

    Route::get('applying-leave-dashboard/progress', [DatatablesApplyingLeaveController::class, 'formProgress'])->name('applying-leave-dashboar.formprogress.data');
    Route::get('applying-leave-dashboard/history', [DatatablesApplyingLeaveController::class, 'historyProgress'])->name('applying-leave-dashboar.historyprogress.data');
    Route::resource('applying-leave-dashboard', ApplyingDashboardController::class)->only(['index', 'show']);

    Route::resource('applying-leave-annual-eoc', AnnualEOCLeaveController::class)->only((['create']));

    Route::resource('applying-leave-exdo', ExdoleaveController::class)->only((['create', 'store']));
});

require __DIR__ . '/auth.php';
