<?php

use App\Http\Controllers\BreedsController;
use App\Http\Controllers\ColorsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StartController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\SpeciesController;

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

Auth::routes(['register' => false]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('Start', [StartController::class, 'index']);

Route::get('Offices', [OfficesController::class, 'index']);

Route::post('Offices', [OfficesController::class, 'store']);

Route::put('Office/{id}', [OfficesController::class, 'update']);

Route::delete('Office/{id}', [OfficesController::class, 'destroy']);

Route::get('Doctors',[DoctorsController::class, 'index']);

Route::post('Doctors', [DoctorsController::class, 'store']);

Route::get('Delete-Doctor/{id}', [DoctorsController::class, 'destroy']);

Route::get('Patients',[PatientsController::class, 'index']);

Route::get('Create-Patients',[PatientsController::class, 'create']);

// SPECIES / ESPECIES
Route::get('Species',[SpeciesController::class, 'index']); //Vista principal del module.species

Route::post('Species',[SpeciesController::class, 'store']); //method=post del new-modal-species

Route::get('Delete-Specie/{id}', [SpeciesController::class, 'destroy']); //funcion ejecutada al confirmar la accion en template.blade.php

Route::get('Edit-Specie/{id}', [SpeciesController::class, 'show']); // Mostrar ventana modal edit con datos actuales

Route::put('Update-Specie/{id}', [SpeciesController::class, 'update']); // Accion de actualizar como tal con los datos actuales

// BREEDS / RAZAS
Route::get('Breeds',[BreedsController::class, 'index']); // Vista principal del module.breeds

Route::post('Breeds',[BreedsController::class, 'store']); // method=post del new-modal-breeds

Route::get('Delete-Breed/{id}', [BreedsController::class, 'destroy']); //funcion ejecutada al confirmar la accion en template.blade.php

Route::get('Edit-Breed/{id}', [BreedsController::class, 'show']); // Mostrar ventana modal edit con datos actuales

Route::put('Update-Breed/{id}', [BreedsController::class, 'update']); // Accion de actualizar como tal con datos nuevos que envia el usuario

Route::get('Pets/Get-Breeds-Specie/{id}', [BreedsController::class, 'getBreedsSpecie']); // Obtener las razas con base en un id_specie (Modulo registro de mascotas)

// COLORS / COLORES
Route::get('Colors',[ColorsController::class, 'index']); // Vista principal del module.colros

Route::post('Colors',[ColorsController::class, 'store']); // method=post del new-modal-color

Route::get('Delete-Color/{id}', [ColorsController::class, 'destroy']); //funcion ejecutada al confirmar la accion en template.blade.php

Route::get('Edit-Color/{id}', [ColorsController::class, 'show']); // Mostrar ventana modal edit con datos actuales

Route::put('Update-Color/{id}', [ColorsController::class, 'update']); //Accion de actualizar como tal, con datos nuevos que envia el usuario

// MEDICINE / MEDICAMENTOS
Route::get('Medicines',[MedicinesController::class, 'index']); // Vista principal del module.medicines

Route::post('Medicines',[MedicinesController::class, 'store']); // method=post del new-modal-medicine

Route::get('Delete-Medicine/{id}', [MedicinesController::class, 'destroy']); //funcion ejecutada al confirmar la accion en template.blade.php

Route::get('Edit-Medicine/{id}', [MedicinesController::class, 'show']); // Mostrar ventana modal edit con datos actuales

Route::put('Update-Medicine/{id}', [MedicinesController::class, 'update']); //Accion de actualizar como tal, con datos nuevos que envia el usuario

// PETS / MASCOTAS
Route::get('Pets',[PetsController::class, 'index']); // Vista principal del module.pets (Activas)

Route::get('Pets-Inactive',[PetsController::class, 'indexInactive']); // Vista principal del module.pets (Activas)

Route::post('Pets',[PetsController::class, 'store']); // method=post del new-modal-pet

Route::get('Delete-Pet/{id}', [PetsController::class, 'destroy']); //funcion ejecutada al confirmar la accion en template.blade.php

Route::get('Edit-Pet/{id}', [PetsController::class, 'show']); // Mostrar ventana modal edit con datos actuales

Route::get('Edit-Pet-Inactive/{id}', [PetsController::class, 'showInactive']); // Mostrar ventana modal edit con datos actuales

Route::put('Update-Pet/{id}', [PetsController::class, 'update']); //Accion de actualizar como tal, con datos nuevos que envia el usuario

Route::put('Update-Pet-Inactive/{id}', [PetsController::class, 'updateInactive']); //Accion de actualizar como tal, con datos nuevos que envia el usuario
