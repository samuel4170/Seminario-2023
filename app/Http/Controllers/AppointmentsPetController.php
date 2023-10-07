<?php

namespace App\Http\Controllers;

use App\Models\AppointmentsPet;
use App\Http\Controllers\Controller;
use App\Models\Medicines;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AppointmentsPetController extends Controller
{
    //Restringe el acceso a usuarios autenticados
    public function __construct()
	{
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria") {
            return redirect('Start');
        }

        $currentPet = Pets::where('id', $id)->first(); // Obtiene un solo registro por ID
        $medicines = Medicines::all();
        $appointments = AppointmentsPet::where('id_pet', $id)->get(); // Obtiene el historial de vacunacion de la mascota
        // Si el usuario tiene un rol con acceso al módulo, entonces retorna la vista correspondiente
        return view('modules.AppointmentsPet', compact('currentPet', 'medicines', 'appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {

            // Reglas de validación para campos requeridos
            $rules = [
                'id_pet' => ['required', 'numeric'],
                'vaccination_date' => ['required', 'date'], // La fecha de vacunacion no puede ser una fecha futura
                'id_medicine' => ['required', 'numeric'],
                'id_user' => ['required', 'numeric'],
                'next_vaccination_date' => ['required', 'date'], // La fecha proxima de vacunacion no puede ser una fecha pasada
            ];

            $request->validate($rules);

            AppointmentsPet::create([
                'id_pet' => $request->input('id_pet'),
                'vaccination_date' => $request->input('vaccination_date'),
                'id_medicine' => $request->input('id_medicine'),
                'id_user' => $request->input('id_user'),
                'next_vaccination_date' => $request->input('next_vaccination_date'),
            ]);

            //Si todo sale bien hasta aqui, redireccionar con mensaje exitoso
            return redirect('AppointmentsPet/' . $id)->with('registered_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: no se envian los campos requeridos a nivel de base de datos

            return redirect('AppointmentsPet/' . $id)->with('registered_unsuccessfully', 'true');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentsPet  $appointmentsPet
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentsPet  $appointmentsPet
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentsPet $appointmentsPet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentsPet  $appointmentsPet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppointmentsPet $appointmentsPet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentsPet  $appointmentsPet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $pet)
    {
        try {
            //Codigo para eliminar el registro del hisotial de X mascota
            DB::table('appointments_pet')->whereId($id)->delete();

            //Si todo sale OK, redireccionar con mensaje exitoso
            return redirect('AppointmentsPet/' . $pet)->with('delete_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: el dato que se va a eliminar se referencia en otras tablas
            return redirect('AppointmentsPet/' . $pet)->with('delete_unsuccessfully', 'true');

        }
    }
}
