<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficesController extends Controller
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
        if ((auth()->user()->role != "Administrador" && auth()->user()->role != "Secretaria")) {
            return redirect('Start');
        }

        $offices = Offices::all();

        return view('modules.Offices')->with('offices', $offices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Offices::create(['office' => request('office')]);

        return redirect('Offices');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offices $offices)
    {
        (Request('id'));
        DB::table('offices')->where('id', request('id'))->update(['office' => request('officeEdit')]);
        return redirect('Offices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offices  $offices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('offices')->where('id', $id)->delete();

        return redirect('Offices');
    }
}
