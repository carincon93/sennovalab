<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TypeService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTypeServiceRequest;
use App\Http\Requests\UpdateTypeServiceRequest;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;

class TypeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('TypeServices/Index', [
            'filters'   => request()->all('search'),
            'typeservices'     => TypeService::orderBy('nombre', 'ASC')
                ->filterTypeService(request()->only('search'))->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('TypeServices/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeServiceRequest $request)
    {
        //
        $typeService = new TypeService();
        $typeService->nombre                    = $request->nombre_tipo_servicio;

        $typeService->save();

        return redirect()->route('types-services.index')->with('success', 'El tipo de servicio se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //error_log("error mensaje");
        $typeservice = TypeService::where('id', '=', $id)->first();
        return Inertia::render('TypeServices/Show', [
            'type_service' => $typeservice
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeservice = TypeService::where('id', '=', $id)->first();
        return Inertia::render('TypeServices/Edit', [
            'type_service' => $typeservice
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeServiceRequest $request, $id)
    {
        $typeservice = TypeService::where('id', '=', $id)->first();
        $typeservice->nombre = $request->nombre_tipo_servicio;
        $typeservice->update();
        return redirect()->back()->with('success', 'El recurso se ha modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeservice = TypeService::where('id', '=', $id)->first();
        $typeservice->delete();
        return redirect()->back()->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
