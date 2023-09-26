<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MedicinesController extends Controller
{
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
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Trea los datos necesarios para mostrar los registros
        $medicines = Medicines::all();
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Medicines')->with('medicines', $medicines);
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
    public function store(Request $request)
    {
        // Se validan los campos
        $data = request()->validate([
            'name' => ['required', 'string', 'min:3', 'unique:medicines'],
            'price' => ['required', 'numeric']
        ]);
        //Despues de haber validado los datos, crear el registro como tal enviando todos los datos
        Medicines::create([
            'name' => $data['name'],
            'price' => $data['price']
        ]);
        return redirect('Medicines')->with('registered_successfully', 'true'); // variable de sesion operacion OK
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Trea los datos necesarios para mostrar los registros
        $medicines = Medicines::all();
        $medicineX = Medicines::find($id); //el id que esta en la url
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Medicines-edit', compact('medicines', 'medicineX'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicines $medicines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicines $id)
    {
        //No siempre se van a cambiar los dos valores, a veces solo se va a cambiar el precio pero no el nombre y viceversa
        if($id['price'] != $request['price']){// Cuando se cambia el precio
            // Se validan los campos
            $data = request()->validate([
                'price' => ['required', 'numeric']
            ]);
            DB::table('medicines')->where('id', $id['id'])->update(['price' => $data['price']]);
        }
        if($id['name'] != $request['name']){//Si se cambia el nombre
            // Se validan los campos
            $data = request()->validate([
                'name' => ['required', 'string', 'min:3', 'unique:medicines'],
            ]);
            DB::table('medicines')->where('id', $id['id'])->update(['name' => $data['name']]);
        }
        return redirect('Medicines')->with('update_successfully', 'true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Código para eliminar @medicamento
            Medicines::destroy($id);
            // Si todo sale OK, redireccionar con mensaje exitoso
            return redirect('Medicines')->with('delete_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: el dato que se va a eliminar se referencia en otras tablas
            return redirect('Medicines')->with('delete_unsuccessfully', 'true');
        }
    }
}
