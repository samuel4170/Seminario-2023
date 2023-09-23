<?php

namespace App\Http\Controllers;

use App\Models\Start;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StartController extends Controller
{
    //Indica que para acceder a este modulo debemos de estar si o si autenticados.
    public function __construct()
    {
        $this -> middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.Start');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function show(Start $start)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function edit(Start $start)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Start $start)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Start  $start
     * @return \Illuminate\Http\Response
     */
    public function destroy(Start $start)
    {
        //
    }
}
