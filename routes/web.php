<?php

use App\Http\Controllers\HRD\Datatables\EmployesDatatables;
use App\Http\Controllers\HRD\EmpoyesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
    Route::resource('employes', EmpoyesController::class)->middleware('auth');
});

require __DIR__.'/auth.php';


