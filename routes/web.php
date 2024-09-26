<?php

use App\Http\Controllers\HRD\Annual\AnnualController;
use App\Http\Controllers\HRD\Datatables\AnnualeaveDatatablesController;
use App\Http\Controllers\HRD\Datatables\EmployesDatatables;
use App\Http\Controllers\HRD\Employes\CustomEmployesController;
use App\Http\Controllers\HRD\Employes\EmpoyesController;
use App\Http\Controllers\ProfileController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('hrd')->group(function() {
    Route::get('employes/data', [EmployesDatatables::class, 'data'])->name('employes.data')->middleware(['auth']);
    Route::get('employes/deactiveData', [EmployesDatatables::class, 'deactiveData'])->name('employes.deactiveData')->middleware(['auth']);
    Route::get('employes/endofContract', [EmployesDatatables::class, 'endofContract'])->name('employes.endofContract')->middleware(['auth']);

    Route::get('employes/annualeave/data', [AnnualeaveDatatablesController::class, 'dataAnnualofEmployes'])->name('employes.annualeave.data')->middleware(['auth']);

    Route::get('employes/actived', [CustomEmployesController::class, 'activeEmployes'])->name('employes.actived')->middleware(['auth']);
    Route::get('employes/annual/{id}', [CustomEmployesController::class, 'annualInput'])->name('employes.annual')->middleware(['auth']);

    Route::resource('employes/annualeave', AnnualController::class)->middleware(['auth']);
    Route::resource('employes', EmpoyesController::class)->middleware(['auth']);

});

require __DIR__.'/auth.php';


