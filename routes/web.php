<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    //servce
    Route::get('/service/index', [ServiceController::class, 'index'])->name('service.index');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');

    //parent Service
    Route::get('/parentService/index', [ServiceController::class, 'parentServiceIndex'])->name('parentService.index');
    Route::post('parentService/store', [ServiceController::class, 'parentServiceStore'])->name('parentService.store');

    //child Service
    Route::get('/childService/index', [ServiceController::class, 'childServiceIndex'])->name('childService.index');
    Route::post('childService/store', [ServiceController::class, 'childServiceStore'])->name('childService.store');

    //Advertisemt
    Route::get('/advertisement/index', [ServiceController::class, 'advertisementIndex'])->name('advertisement.index');
    Route::post('advertisement/store', [ServiceController::class, 'advertisementStore'])->name('advertisement.store');

});
