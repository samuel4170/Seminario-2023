<?php

namespace App\Http\Controllers;

use App\Models\Species;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SpeciesController extends Controller
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
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Trea los datos necesarios para mostrar los registros
        $species = Species::all();
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Species')->with('species', $species);
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
            'name' => ['required', 'string', 'min:3', 'unique:species']
        ]);
        //Despues de haber validado los datos, crear el registro como tal
        Species::create([
            'name' => $data['name'],
        ]);
        return redirect('Species')->with('registered_successfully', 'true'); //variable de sesion para mostrar alertas interactivas
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Trea los datos necesarios para mostrar los registros
        $species = Species::all();
        $specieX = Species::find($id); //el id que esta en la url
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Species-edit', compact('species', 'specieX'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $id)
    {
        //Se valida que el valor actual sea diferente del nuevo valor que se esta enviando
        if($id['name'] != $request['name']){
            // Se validan los campos
            $data = request()->validate([
                'name' => ['required', 'string', 'min:3', 'unique:species']
            ]);
            DB::table('species')->where('id', $id['id'])->update(['name' => $data['name']]);
        }
        return redirect('Species')->with('update_successfully', 'true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Código para eliminar la @especie
            Species::destroy($id);
            // Si todo sale OK, redireccionar con mensaje exitoso
            return redirect('Species')->with('delete_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: el dato que se va a eliminar se referencia en otras tablas
            return redirect('Species')->with('delete_unsuccessfully', 'true');
        }
    }
}
