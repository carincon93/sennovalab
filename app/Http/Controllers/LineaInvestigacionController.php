<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\LineaInvestigacionRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LineaInvestigacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', [LineaInvestigacion::class]);

        return Inertia::render('LineasInvestigacion/Index', [
            'filters'   => request()->all('search'),
            'lineaInvestigacions' => LineaInvestigacion::orderBy('nombre', 'ASC')
                ->filterLineaInvestigacion(request()->only('search'))->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [LineaInvestigacion::class]);

        return Inertia::render('LineasInvestigacion/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineaInvestigacionRequest $request)
    {
        $this->authorize('create', [LineaInvestigacion::class]);

        $lineaInvestigacion = new LineaInvestigacion();
        $lineaInvestigacion->fieldName = $request->fieldName;
        $lineaInvestigacion->fieldName = $request->fieldName;
        $lineaInvestigacion->fieldName = $request->fieldName;

        $lineaInvestigacion->save();

        return redirect()->route('lineas-investigacion.index')->with('success', 'El recurso se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LineaInvestigacion  $lineaInvestigacion
     * @return \Illuminate\Http\Response
     */
    public function show(LineaInvestigacion $lineaInvestigacion)
    {
        $this->authorize('view', [LineaInvestigacion::class, $lineaInvestigacion]);

        return Inertia::render('LineasInvestigacion/Show', [
            'lineaInvestigacion' => $lineaInvestigacion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LineaInvestigacion  $lineaInvestigacion
     * @return \Illuminate\Http\Response
     */
    public function edit(LineaInvestigacion $lineaInvestigacion)
    {
        $this->authorize('update', [LineaInvestigacion::class, $lineaInvestigacion]);

        return Inertia::render('LineasInvestigacion/Edit', [
            'lineaInvestigacion' => $lineaInvestigacion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LineaInvestigacion  $lineaInvestigacion
     * @return \Illuminate\Http\Response
     */
    public function update(LineaInvestigacionRequest $request, LineaInvestigacion $lineaInvestigacion)
    {
        $this->authorize('update', [LineaInvestigacion::class, $lineaInvestigacion]);

        $lineaInvestigacion->fieldName = $request->fieldName;
        $lineaInvestigacion->fieldName = $request->fieldName;
        $lineaInvestigacion->fieldName = $request->fieldName;

        $lineaInvestigacion->save();

        return redirect()->back()->with('success', 'El recurso se ha modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LineaInvestigacion  $lineaInvestigacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineaInvestigacion $lineaInvestigacion)
    {
        $this->authorize('delete', [LineaInvestigacion::class, $lineaInvestigacion]);

        $lineaInvestigacion->delete();

        return redirect()->route('lineas-investigacion.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
