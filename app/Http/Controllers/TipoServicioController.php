<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTipoServicioRequest;
use App\Http\Requests\UpdateTipoServicioRequest;
use Inertia\Inertia;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('TiposServicios/Index', [
            'filters'           => request()->all('search'),
            'tipos_servicios'   => TipoServicio::orderBy('nombre', 'ASC')
                ->filterTipoServicio(request()->only('search'))->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('TiposServicios/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoServicioRequest $request)
    {
        $tipo_servicio = new TipoServicio();
        $tipo_servicio->nombre = $request->nombre;

        $tipo_servicio->save();

        return redirect()->route('tipos-servicios.index')->with('success', 'El tipo de servicio se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoServicio $tipo_servicio)
    {
        return Inertia::render('TiposServicios/Show', [
            'tipo_servicio' => $tipo_servicio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoServicio $tipo_servicio)
    {
        return Inertia::render('TiposServicios/Edit', [
            'tipo_servicio' => $tipo_servicio
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoServicioRequest $request, TipoServicio $tipo_servicio)
    {
        $tipo_servicio->nombre = $request->nombre;
        $tipo_servicio->update();
        return redirect()->back()->with('success', 'El recurso se ha modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoServicio $tipo_servicio)
    {
        $tipo_servicio->delete();
        return redirect()->back()->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
