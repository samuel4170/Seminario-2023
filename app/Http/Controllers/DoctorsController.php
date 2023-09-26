<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Http\Controllers\Controller;
use App\Models\Offices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //aplicar encriptacion de data en password
use Illuminate\Support\Facades\DB;

class DoctorsController extends Controller
{
    //Indica que para acceder a este modulo debemos de estar si o si autenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Estos roles tienen acceso al modulo de doctores.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start');//Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Traer los datos necesarios para crear un Doctor
        $offices = Offices::all();
        // Trea los datos necesarios para mostrar los Doctores registrados
        $doctors = Doctors::all();
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Doctors', compact('offices', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Almacenar los datos enviados en el request
        $data = request() -> validate([
            'name' => ['required'],
            'genre' => ['required'],
            'id_consulting_room' => ['required'],
            'email' => ['required', 'string','email', 'unique:users'],
            'password' => ['required', 'string', 'min:4'],
        ]);
        //Despues de haber validado los datos, crear el registro como tal
        Doctors::create([
            'name' => $data['name'],
            'genre' => $data['genre'],
            'id_consulting_room' => $data['id_consulting_room'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Doctor',
            'document' => '',
            'phone' => '',
        ]);
        return redirect('Doctors')->with('registered_successfully', 'true'); //variable de sesion para mostrar alertas interactivas
    }

    public function destroy($id)
    {
        DB::table('users')->whereId($id)->delete();
        return redirect('Doctors');
    }
}
