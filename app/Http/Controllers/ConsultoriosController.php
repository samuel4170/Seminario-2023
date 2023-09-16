<?php

namespace App\Http\Controllers;

use App\Models\Consultorios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class ConsultoriosController extends Controller
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
        return view('modulos.Consultorios')->with('consultorios', $consultorios);
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
        Consultorios::create(['consultorio' => request('consultorio')]);
        
        return Redirect('Consultorios');
    }


    public function show(Consultorios $consultorios)
    {
        //
    }


    public function edit(Consultorios $consultorios)
    {
        //
    }


    public function update(Request $request)
    {
        DB::table('consultorios')->where('id', request('id'))->update(['consultorio' => request('consultorioE')]);

        return Redirect('Consultorios');
    }

    public function destroy($id)
    {
        DB::table('consultorios')->whereId($id)->delete();
        
        return Redirect('Consultorios');
    }
}
