<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use App\Models\Consultorios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctoresController extends Controller
{
    
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria')
        {
            return redirect('Inicio');
        }
        
        $consultorios = Consultorios::all();

        $doctores =Doctores::all();

        return view('modulos.Doctores', compact('consultorios', 'doctores'));
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


    public function store(Request $request)
    {
        $datos = request()->validate([

            'id_consultorio' => ['required'],
            'name' => ['required'],
            'telefono' => ['required'],
            'sexo' => ['required'],
            'DPI' => ['required'],
            'password' => ['required','string','min:3'],
            'email'  =>  ['required','string','email','unique:users']
        ]);
    
           Doctores::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'DPI' => $datos['DPI'],
            'telefono' => $datos['telefono'],
            'id_consultorio' => $datos['id_consultorio'],
            'rol' => 'Doctor',
            'sexo' => $datos['sexo'],
            'password' => Hash::make($datos['password'])
           ]);
           return redirect('Doctores')->with('registrado','Si');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctores  $doctores
     * @return \Illuminate\Http\Response
     */
    public function show(Doctores $doctores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctores  $doctores
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctores $doctores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctores  $doctores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctores $doctores)
    {
        //
    }


    public function destroy($id)
    {
        DB::table('users')->whereId($id)->delete();

        return redirect('Doctores');
        
    }
}
