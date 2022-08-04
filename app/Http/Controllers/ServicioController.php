<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicioRequest;
use App\Models\UserExterno;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny', [Servicio::class]);

        return Inertia::render('Servicios/Index', [
            'filters'   => request()->all('search'),
            'servicios' => Servicio::orderBy('codigo_servicio', 'ASC')
                ->filterServicio(request()->only('search'))->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', [Servicio::class]);

        return Inertia::render('Servicios/Create', [
            'users_externos' => UserExterno::select('user_externo.id as value', 'users.primer_nombre as label')->join('users', 'user_externo.user_id', 'users.id')->get(),
            'lineas_desarrollo' => array(['value' => 1, 'label' => 'Línea 1']), //quemado//
            'categorias_linea_desarrollo' => array(['value' => 1, 'label' => 'Categoría de la línea 1']), //quemado//
            'tipos_servicios' => array(['value' => 1, 'label' => 'Tipo de servicio 1']) //quemado//
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicioRequest $request)
    {
        // $this->authorize('create', [Servicio::class]);

        $servicio = new Servicio();
        $servicio->userExterno()->associate($request->user_externo_id);
        $servicio->categoria_linea_desarrollo_id = $request->categoria_linea_desarrollo_id;
        $servicio->tipo_servicio_id = $request->tipo_servicio_id;
        $servicio->descripcion_necesidad = $request->descripcion_necesidad;
        $servicio->codigo_servicio = '01'; //quemado//


        $servicio->save();

        return redirect()->route('servicios.index')->with('success', 'El recurso se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        // $this->authorize('view', [Servicio::class, $servicio]);

        return Inertia::render('Servicios/Show', [
            'servicio' => $servicio
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        error_log($servicio);

        // $this->authorize('update', [Servicio::class, $servicio]);

        return Inertia::render('Servicios/Edit', [
            'servicio' => $servicio,
            'users_externos' => UserExterno::select('user_externo.id as value', 'users.primer_nombre as label')->join('users', 'user_externo.user_id', 'users.id')->get(),
            'lineas_desarrollo' => array(['value' => 1, 'label' => 'Línea 1']), //quemado//
            'categorias_linea_desarrollo' => array(['value' => 1, 'label' => 'Categoría de la línea 1']), //quemado//
            'tipos_servicios' => array(['value' => 1, 'label' => 'Tipo de servicio 1']) //quemado//
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(ServicioRequest $request, Servicio $servicio)
    {
        // $this->authorize('update', [Servicio::class, $servicio]);

        $servicio->userExterno()->associate($request->user_externo_id);
        $servicio->categoria_linea_desarrollo_id = $request->categoria_linea_desarrollo_id;
        $servicio->tipo_servicio_id = $request->tipo_servicio_id;
        $servicio->descripcion_necesidad = $request->descripcion_necesidad;


        $servicio->save();

        return redirect()->back()->with('success', 'El recurso se ha modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        // $this->authorize('delete', [Servicio::class, $servicio]);

        $servicio->delete();

        return redirect()->route('.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
