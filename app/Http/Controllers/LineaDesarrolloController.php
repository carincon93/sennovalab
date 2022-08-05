<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LineaDesarrolloRequest;
use Illuminate\Http\Request;
use App\Models\LineaDesarrollo;
use Inertia\Inertia;

class LineaDesarrolloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('LineasDesarrollo/Index', [
            'filters'   => request()->all('search'),
            'lineas_desarrollo'    => LineaDesarrollo::orderBy('nombre', 'ASC')
                ->filterLineasDesarrollo(request()->only('search'))->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('LineasDesarrollo/Create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineaDesarrolloRequest $request)
    {
        $linea_desarrollo = new LineaDesarrollo();
        $linea_desarrollo->nombre = $request->nombre;

        $linea_desarrollo->save();

        return redirect()->route('lineas-desarrollo.index')->with('success', 'El recurso se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LineaDesarrollo  $linea_desarrollo
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Inertia::render('LineasDesarrollo/Show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LineaDesarrollo  $linea_desarrollo
     * @return \Illuminate\Http\Response
     */
    public function edit(LineaDesarrollo $linea_desarrollo)
    {
        return Inertia::render('LineasDesarrollo/Edit', [
            'linea_desarrollo' => $linea_desarrollo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LineaDesarrollo  $linea_desarrollo
     * @return \Illuminate\Http\Response
     */
    public function update(LineaDesarrolloRequest $request, LineaDesarrollo $linea_desarrollo)
    {
        $linea_desarrollo->nombre = $request->nombre;

        $linea_desarrollo->save();

        return redirect()->route('lineas-desarrollo.index')->with('success', 'El recurso se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LineaDesarrollo  $linea_desarrollo
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineaDesarrollo $linea_desarrollo)
    {
        $linea_desarrollo->delete();

        return redirect()->route('lineas-desarrollo.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
