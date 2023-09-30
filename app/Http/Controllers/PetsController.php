<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use App\Http\Controllers\Controller;
use App\Models\Breeds;
use App\Models\Colors;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Util\SpecReader;
use PhpParser\Node\Stmt\TryCatch;

class PetsController extends Controller
{
    /**
     * Restringe el acceso solamente para usuarios autenticados
     */
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
        // Traer los datos necesarios para crear un registro:
        $species = Species::orderBy('name', 'asc')->get();
        $colors = Colors::orderBy('name', 'asc')->get();
        // Trea los datos necesarios para mostrar los registrados
        $pets = Pets::orderBy('owner_name', 'asc')->where('status', '1')->get();
        //Si es un usuario que debe de tener acceso al modulo, entonces retornar la vista correspondiente
        return view('modules.Pets', compact('species', 'colors', 'pets'));
    }

    // Trae el registro de mascotas que especificamente están inactivas.
    public function indexInactive()
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Traer los datos necesarios para crear un registro:
        $species = Species::orderBy('name', 'asc')->get();
        $colors = Colors::orderBy('name', 'asc')->get();
        // Trea los datos necesarios para mostrar los registrados
        $pets = Pets::orderBy('owner_name', 'asc')->where('status', '0')->get();
        //Si es un usuario que debe de tener acceso al modulo, entonces retornar la vista correspondiente
        return view('modules.Pets-Inactive', compact('species', 'colors', 'pets'));
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
        try {

            // Reglas de validación para campos requeridos
            $rules = [
                'owner_name' => ['required', 'string', 'min:5'],
                'owner_phone' => ['required', 'numeric', 'regex:/^\d{8}$/'], // Validar números de teléfono con exactamente 8 dígitos
                'pet_name' => ['required', 'string'],
                'id_specie' => ['required', 'numeric'],
                'id_breed' => ['required', 'numeric'],
                'pet_sex' => ['required', 'boolean'],
                'id_color' => ['required', 'numeric'],
                'birthdate' => ['required', 'date', 'birthdate_not_future'],
            ];

            // Aplicar reglas de validación condicionales para owner_email y add_info
            $request->validate([
                'owner_email' => ['sometimes', 'required', 'email'], // 'sometimes' valida solo si owner_email está presente
                'add_info' => ['sometimes', 'string', 'min:5'], // 'sometimes' valida solo si add_info está presente
            ] + $rules);

            if($request -> input ('owner_email')){//se envia email
                if($request -> input ('add_info')){// se envia info adicional
                    Pets::create([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => $request->input('owner_email'), // dato en solicitud
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => $request->input('add_info'), // dato en solicitud
                        'status' => '1',
                    ]);
                }else{
                    Pets::create([ // no se envia info adicional pero si email
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => $request->input('owner_email'), // dato en solicitud
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => '(No hay detalles adicionales)', // default value
                        'status' => '1',
                    ]);
                }
            }else if(!($request -> input ('owner_email'))){//no se envia email
                if($request -> input ('add_info')){// se envia info adicional
                    Pets::create([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => '(Sin registrar)', // default value
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => $request->input('add_info'), // dato en solicitud
                        'status' => '1',
                    ]);
                }else{//No se envia ni correo ni info adicional
                    Pets::create([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => '(Sin registrar)', // default value
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => '(No hay detalles adicionales)', // defaul value
                        'status' => '1',
                    ]);
                }
            }
            //Si todo sale bien hasta aqui, redireccionar con mensaje exitoso
            return redirect('Pets')->with('registered_successfully', 'true');
        } catch (QueryException $e) { //Posibles errores: no se envian los campos requeridos a nivel de base de datos
            return redirect('Pets')->with('registered_unsuccessfully', 'true');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Traer los datos necesarios para crear un registro:
        $species = Species::orderBy('name', 'asc')->get();
        $colors = Colors::orderBy('name', 'asc')->get();
        // Trea los datos necesarios para mostrar los registrados
        $pets = Pets::orderBy('owner_name', 'asc')->where('status', '1')->get();
        // Datos actuales del registro que se pretende editar
        $petX = Pets::find($id); //el id que esta en la url
        //Si es un usuario que debe de tener acceso al modulo, entonces retornar la vista correspondiente
        return view('modules.Pets-edit', compact('species', 'colors', 'pets', 'petX'));
    }

    public function showInactive($id)
    {
        //Estos roles tienen acceso al modulo.
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start'); //Si el rol del usuaario no es de administrador o secretaria, se le redirecciona
        }
        // Traer los datos necesarios para crear un registro:
        $species = Species::orderBy('name', 'asc')->get();
        $colors = Colors::orderBy('name', 'asc')->get();
        // Trea los datos necesarios para mostrar los registrados
        $pets = Pets::orderBy('owner_name', 'asc')->where('status', '0')->get();
        // Datos actuales del registro que se pretende editar
        $petX = Pets::find($id); //el id que esta en la url
        //Si es un usuario que debe de tener acceso al modulo, entonces retornar la vista correspondiente
        return view('modules.Pets-edit-inactive', compact('species', 'colors', 'pets', 'petX'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function edit(Pets $pets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pets $id)
    {
        // $current['property'] -> es el dato actual del registro por actualizar.
        // $request['property'] -> es el nuevo dato enviado en la solicitud HTTP.
        try {

            // Reglas de validación para campos requeridos
            $rules = [
                'owner_name' => ['required', 'string', 'min:5'],
                'owner_phone' => ['required', 'numeric', 'regex:/^\d{8}$/'], // Validar números de teléfono con exactamente 8 dígitos
                'pet_name' => ['required', 'string'],
                'id_specie' => ['required', 'numeric'],
                'id_breed' => ['required', 'numeric'],
                'pet_sex' => ['required', 'boolean'],
                'pet_status' => ['required', 'boolean'],
                'id_color' => ['required', 'numeric'],
                'birthdate' => ['required', 'date', 'birthdate_not_future'],
            ];

            // Aplicar reglas de validación condicionales para owner_email y add_info
            $request->validate([
                'owner_email' => ['sometimes', 'required', 'email'], // 'sometimes' valida solo si owner_email está presente
                'add_info' => ['sometimes', 'string', 'min:5'], // 'sometimes' valida solo si add_info está presente
            ] + $rules);

            if($request -> input ('owner_email')){// se envia email
                if($request -> input ('add_info')){// se envia info adicional
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => $request->input('owner_email'), // dato en solicitud
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => $request->input('add_info'), // dato en solicitud
                        'status' => $request->input('pet_status'),
                    ]);
                }else{
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([ // no se envia info adicional pero si email
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => $request->input('owner_email'), // dato en solicitud
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => '(No hay detalles adicionales)', // default value
                        'status' => $request->input('pet_status'),
                    ]);
                }
            }else if(!($request -> input ('owner_email'))){//no se envia email
                if($request -> input ('add_info')){// se envia info adicional
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => '(Sin registrar)', // default value
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => $request->input('add_info'), // dato en solicitud
                        'status' => $request->input('pet_status'),
                    ]);
                }else{//No se envia ni correo ni info adicional
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => '(Sin registrar)', // default value
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => '(No hay detalles adicionales)', // defaul value
                        'status' => $request->input('pet_status'),
                    ]);
                }
            }
            //Si todo sale bien hasta aqui, redireccionar con mensaje exitoso
            return redirect('Pets')->with('update_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: no se envian los campos requeridos a nivel de base de datos

            return redirect('Pets')->with('update_unsuccessfully', 'true');

        }
    }

    public function updateInactive(Request $request, Pets $id)
    {
        // $current['property'] -> es el dato actual del registro por actualizar.
        // $request['property'] -> es el nuevo dato enviado en la solicitud HTTP.
        try {

            // Reglas de validación para campos requeridos
            $rules = [
                'owner_name' => ['required', 'string', 'min:5'],
                'owner_phone' => ['required', 'numeric', 'regex:/^\d{8}$/'], // Validar números de teléfono con exactamente 8 dígitos
                'pet_name' => ['required', 'string'],
                'id_specie' => ['required', 'numeric'],
                'id_breed' => ['required', 'numeric'],
                'pet_sex' => ['required', 'boolean'],
                'pet_status' => ['required', 'boolean'],
                'id_color' => ['required', 'numeric'],
                'birthdate' => ['required', 'date', 'birthdate_not_future'],
            ];

            // Aplicar reglas de validación condicionales para owner_email y add_info
            $request->validate([
                'owner_email' => ['sometimes', 'required', 'email'], // 'sometimes' valida solo si owner_email está presente
                'add_info' => ['sometimes', 'string', 'min:5'], // 'sometimes' valida solo si add_info está presente
            ] + $rules);

            if($request -> input ('owner_email')){// se envia email
                if($request -> input ('add_info')){// se envia info adicional
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => $request->input('owner_email'), // dato en solicitud
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => $request->input('add_info'), // dato en solicitud
                        'status' => $request->input('pet_status'),
                    ]);
                }else{
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([ // no se envia info adicional pero si email
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => $request->input('owner_email'), // dato en solicitud
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => '(No hay detalles adicionales)', // default value
                        'status' => $request->input('pet_status'),
                    ]);
                }
            }else if(!($request -> input ('owner_email'))){//no se envia email
                if($request -> input ('add_info')){// se envia info adicional
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => '(Sin registrar)', // default value
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => $request->input('add_info'), // dato en solicitud
                        'status' => $request->input('pet_status'),
                    ]);
                }else{//No se envia ni correo ni info adicional
                    DB::table('pets')
                    ->where('id', $id['id'])
                    ->update([
                        'owner_name' => $request->input('owner_name'),
                        'owner_phone' => $request->input('owner_phone'),
                        'owner_email' => '(Sin registrar)', // default value
                        'pet_name' => $request->input('pet_name'),
                        'id_specie' => $request->input('id_specie'),
                        'id_breed' => $request->input('id_breed'),
                        'pet_sex' => $request->input('pet_sex'),
                        'id_color' => $request->input('id_color'),
                        'birthdate' => $request->input('birthdate'),
                        'add_info' => '(No hay detalles adicionales)', // defaul value
                        'status' => $request->input('pet_status'),
                    ]);
                }
            }
            //Si todo sale bien hasta aqui, redireccionar con mensaje exitoso
            return redirect('Pets-Inactive')->with('update_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: no se envian los campos requeridos a nivel de base de datos

            return redirect('Pets-Inactive')->with('update_unsuccessfully', 'true');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //Codigo para eliminar la @mascota
            DB::table('pets')->whereId($id)->delete();
            //Si todo sale OK, redireccionar con mensaje exitoso
            return redirect('Pets')->with('delete_successfully', 'true');

        } catch (QueryException $e) { //Posibles errores: el dato que se va a eliminar se referencia en otras tablas
            return redirect('Pets')->with('delete_unsuccessfully', 'true');
        }
    }
}
