<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StartController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\DoctorsController;

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
    return view('modules.Select');
});

Route::get('/Login', function () {
    return view('modules.Login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('Start', [StartController::class, 'index']);

Route::get('Offices', [OfficesController::class, 'index']);

Route::post('Offices', [OfficesController::class, 'store']);

Route::put('Office/{id}', [OfficesController::class, 'update']);

Route::delete('Office/{id}', [OfficesController::class, 'destroy']);

Route::get('Doctors',[DoctorsController::class, 'index']);

Route::post('Doctors', [DoctorsController::class, 'store']);

// Delete
Route::get('Delete-Doctor/{id}', [DoctorsController::class, 'destroy']);
