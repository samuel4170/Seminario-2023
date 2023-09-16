<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\CitasController;

use App\Http\Controllers\DoctoresController;

Route::get('/', function () {
    return view('modulos.Seleccionar');
});

Route::get('/Ingresar', function () {
    return view('modulos.Ingresar');
});

Auth::routes();

Route::get('Inicio', [InicioController::class, 'Index']);

//consultorios
Route::get('Consultorios', [ConsultoriosController::class, 'Index']);
Route::post('Consultorios', [ConsultoriosController::class, 'store']);
Route::put('Consultorio/{id}', [ConsultoriosController::class, 'update']);
Route::delete('borrar-Consultorio/{id}', [ConsultoriosController::class, 'destroy']);


Route::get('Doctores', [DoctoresController::class, 'Index']);
Route::post('Doctores', [DoctoresController::class, 'store']);
Route::get('Eliminar-Doctor/{id}', [DoctoresController::class, 'destroy']);


// rutas de pacientes
Route::get('Pacientes',[PacientesController::class, 'Index']);
Route::get('Crear-Paciente',[PacientesController::class, 'create']);
Route::post('Crear-Paciente',[PacientesController::class, 'store']);
Route::get('Editar-Paciente/{id}',[PacientesController::class, 'edit']);
Route::put('actualizar-paciente/{paciente}',[PacientesController::class, 'update']);
Route::get('Eliminar-Paciente/{id}',[PacientesController::class, 'destroy']);


//citas
Route::get('Citas/{id}',[CitasController::class, 'index']);
Route::post('Citas/{id}',[CitasController::class, 'HorarioDoctor']);
Route::put('editar-horario/{id}',[CitasController::class, 'EditarHorario']);