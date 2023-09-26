<?php

namespace App\Http\Controllers;

use App\Models\Inicio;
use Illuminate\Http\Request;

class InicioController extends Controller
{
   public function __construct()
   {
     $this->middleware('auth');
   }

    public function index()
    {
        return view('modulos.Inicio');
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
        //
    }


    public function show(Inicio $inicio)
    {
        //
    }


    public function edit(Inicio $inicio)
    {
        //
    }


    public function update(Request $request, Inicio $inicio)
    {
        //
    }


    public function destroy(Inicio $inicio)
    {
        //
    }
}
