<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CitasController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index($id)
    {
        if(auth()->user()->rol == "Doctor" && $id != auth()->user()->id){
            return redirect('Inicio');
        }

        $horarios = DB::select('select * from horarios where id_doctor = '.$id);

        $pacientes = Pacientes::all();

        $citas = Citas::all()->where('id_doctor', $id);

        return view('modulos.Citas', compact('horarios', 'pacientes','citas'));
    }



    public function create()
    {
        //
    }


    public function HorarioDoctor(Request $request)
    {
        $datos = request();

        DB::table('horarios')->insert(['id_doctor'=> auth()->user()->id, 'horaInicio' => $datos["horaInicio"], 'horaFin' => $datos["horaFin"]]);

        return redirect('Citas/'.auth()->user()->id);
        

    }

    public function EditarHorario(Request $request)
    {
        $datos = request();

        DB::table('horarios')->where('id', $datos['id'])->update(['horaInicio' => $datos["horaInicioE"
        ], 'horaFin' => $datos["horaFinE"]]);

        return redirect('Citas/'.auth()->user()->id);
        

    }

    public function CrearCita(Request $id_doctor)
    {
        Citas::create(['id_doctor' => request('id_doctor'), 'id_paciente' => request('id_paciente'),
        'FyHinicio' => request('FyHinicio'), 'FyHfinal' => request('FyHfinal')]);
    
        return redirect('Citas/'.request('id_doctor'));
    }

    
    
    public function show(Citas $citas)
    {
        //
    }

    public function edit(Citas $citas)
    {
        //
    }

    public function update(Request $request, Citas $citas)
    {
        //
    }


    public function destroy(Citas $citas)
    {
        DB::table('citas')->whereId(request('idCita'))->delete();

        return redirect('Citas/'.request('idDoctor'));
    }
}
