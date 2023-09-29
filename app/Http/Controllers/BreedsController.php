<?php

namespace App\Http\Controllers;

use App\Models\Breeds;
use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class BreedsController extends Controller
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
        // Traer los datos necesarios para crear un registro
        $species = Species::orderBy('name', 'desc')->get();
        // Trea los datos necesarios para mostrar los registrados
        $breeds = Breeds::orderBy('name', 'asc')->get();
        //Si es un usuario que debe de tener acceso al modulo, entonces retornar la vista correspondiente
        return view('modules.Breeds', compact('species', 'breeds'));
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
            'id_specie' => ['required'],
            'name' => ['required', 'string', 'min:3', 'unique:breeds'],
        ]);
        //Despues de haber validado los datos, crear el registro como tal
        Breeds::create([
            'name' => $data['name'],
            'id_specie' => $data['id_specie'],
        ]);
        return redirect('Breeds')->with('registered_successfully', 'true'); // variable de sesion para mostrar alertas interactivas
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Breeds  $breeds
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Traer los datos necesarios para crear un registro
        $species = Species::all();
        // Trea los datos necesarios para mostrar los registrados
        $breeds = Breeds::all();
        // Datos actuales del registro que se pretende editar
        $breedX = Breeds::find($id); //el id que esta en la url
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Breeds-edit', compact('species', 'breeds', 'breedX'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Breeds  $breeds
     * @return \Illuminate\Http\Response
     */
    public function edit(Breeds $breeds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Breeds  $breeds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Breeds $id)
    {
        //Se valida que el valor actual sea diferente del nuevo valor que se esta enviando
        if(($id['name'] != $request['name']) || ($id['id_specie'] != $request['id_specie'])){
            // Se validan los campos
            $data = request()->validate([
                'id_specie' => ['required'],
                'name' => ['required', 'string', 'min:3', 'unique:breeds'],
            ]);
            DB::table('breeds')
            ->where('id', $id['id'])
            ->update([
            'name' => $data['name'],
            'id_specie' => $data['id_specie']
            ]);
        }
        return redirect('Breeds')->with('update_successfully', 'true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Breeds  $breeds
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //Codigo para eliminar la @raza
            DB::table('breeds')->whereId($id)->delete();
            //Si todo sale OK, redireccionar con mensaje exitoso
            return redirect('Breeds')->with('delete_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: el dato que se va a eliminar se referencia en otras tablas
            return redirect('Breeds')->with('delete_unsuccessfully', 'true');
        }
    }

    // Realiza una consulta en la base de datos para obtener las razas correspondientes a la especie seleccionada
    public function getBreedsSpecie($id) {
        $breeds_specie = Breeds::where('id_specie', $id)
            ->orderBy('name', 'asc') // Ordenar por nombre en orden ascendente
            ->get();
        return response()->json($breeds_specie);
    }

}
