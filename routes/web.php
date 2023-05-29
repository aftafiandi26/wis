<?php

use App\Http\Controllers\Superadmin\HRD\DatatablesController;
use App\Http\Controllers\Superadmin\HRD\EmployesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('superadmin')->group(function () {
    Route::prefix('hrd')->group(function () {
        Route::get('employes/data', [DatatablesController::class, 'superadminEmployes'])->name('superadmin.employes.data');
        Route::resource('employes', EmployesController::class)->names([
            'index' => 'superadmin.employes.index',
            'create' => 'superadmin.employes.create',
            'store' => 'superadmin.employes.store',
            'show' => 'superadmin.employes.show',
            'edit' => 'superadmin.employes.edit',
            'update' => 'superadmin.employes.update',
            'destroy' => 'superadmin.employes.destroy',
        ]);
    });
});
