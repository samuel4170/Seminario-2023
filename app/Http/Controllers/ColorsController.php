<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class ColorsController extends Controller
{
    // Indica que solo pueden acceder a este modulo usuarios autenticados
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
        $colors = Colors::all();
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Colors')->with('colors', $colors);
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
            'name' => ['required', 'string', 'min:3', 'unique:colors']
        ]);
        //Despues de haber validado los datos, crear el registro como tal
        Colors::create([
            'name' => $data['name'],
        ]);
        return redirect('Colors')->with('registered_successfully', 'true'); // variable de sesion operacion OK
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Trea los datos necesarios para mostrar los registros
        $colors = Colors::all();
        $colorX = Colors::find($id); //el id que esta en la url
        //Si es un usuario que debe de tener acceso al modulo, entones retornar la vista correspondiente
        return view('modules.Colors-edit', compact('colors', 'colorX'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function edit(Colors $colors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colors $id)
    {
        //Se valida que el valor actual sea diferente del nuevo valor que se esta enviando
        if($id['name'] != $request['name']){
            // Se validan los campos
            $data = request()->validate([
                'name' => ['required', 'string', 'min:3', 'unique:colors']
            ]);
            DB::table('colors')->where('id', $id['id'])->update(['name' => $data['name']]);
        }
        return redirect('Colors')->with('update_successfully', 'true');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Código para eliminar la @especie
            Colors::destroy($id);
            // Si todo sale OK, redireccionar con mensaje exitoso
            return redirect('Colors')->with('delete_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: el dato que se va a eliminar se referencia en otras tablas
            return redirect('Colors')->with('delete_unsuccessfully', 'true');
        }
    }
}
