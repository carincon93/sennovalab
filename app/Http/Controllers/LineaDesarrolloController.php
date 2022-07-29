<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\LineasDesarrollo;
use Inertia\Inertia;



class LineaDesarrolloController extends Controller
{
    //
    public function index()
    {

        return Inertia::render('Lineas/Index', [
            'filters'   => request()->all('search'),
            'lineas'     => LineasDesarrollo::orderBy('nombre', 'ASC')
                ->FilterLineas(request()->only('search'))->paginate(),
        ]);

    }

    public function create()
    {
        return Inertia::render('Lineas/Create',);
    }
    public function show()
    {
        return Inertia::render('Lineas/Show');
    }

    public function destroy( $lineaId)
    {

        LineasDesarrollo::where('id', $lineaId)->delete();
        return redirect()->route('lineas-investigacion.index')->with('success', 'El recurso se ha eliminado correctamente.');

    }

    public function store(Request $request)
    {

        $linea = new LineasDesarrollo();
        $linea->nombre   = $request->nombre_linea;
        $linea->save();
        return redirect()->route('lineas-investigacion.index');

    }


    public function edit( $id)
    {
        $linea_Desarrollo = LineasDesarrollo::where('id', '=', $id)->first();

          return Inertia::render('Lineas/Edit', [
            'linea_Desarrollo' => $linea_Desarrollo
        ]);


    }

    public function update(Request $request,$id_linea)
    {

        $ide = $request->id_linea;
        $name = $request->nombre_linea;

        $exist = LineasDesarrollo::where('id', '=', $ide)->where('nombre', '=', $name)->exists();

        if ($exist) {
        return redirect()->route('lineas-investigacion.index')->with('error', 'error el nombre de la linea ya existe.');

        }
        else {
            LineasDesarrollo::where('id', '=', $ide)
                        ->update(['nombre' => $name]);

            return redirect()->route('lineas-investigacion.index')->with('success', 'El recurso se ha Actualizado correctamente.');
        }

    }
}
