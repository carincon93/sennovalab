<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserExterno;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserExternoRequest;
use App\Http\Requests\UpdateUserExternoRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserExternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', [UserExterno::class]);

        return Inertia::render('Users/UsersExternos/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserExternoRequest $request)
    {
        // $this->authorize('create', [UserExterno::class]);

        $user = new User();
        $user->primer_nombre                    = $request->primer_nombre;
        $user->segundo_nombre                   = $request->segundo_nombre;
        $user->primer_apellido                  = $request->primer_apellido;
        $user->segundo_apellido                 = $request->segundo_apellido;
        $user->email                            = $request->email;
        $user->password                         = $user::makePassword($request->numero_documento);
        $user->tipo_documento                   = $request->tipo_documento;
        $user->numero_documento                 = $request->numero_documento;
        $user->celular                          = $request->celular;
        $user->telefono                         = $request->telefono;
        $user->extension                        = $request->extension;
        $user->estado                           = $request->estado;
        $user->autorizacion_tratamiento_datos   = $request->autorizacion_tratamiento_datos;

        $user->save();

        $user_externo = new UserExterno();
        $user_externo->codigo_cliente            = $user_externo::makeCodigo($user->id, $user->created_at);
        $user_externo->tipo_usuario              = $request->tipo_usuario;
        $user_externo->empresa_centro_formacion  = $request->empresa_centro_formacion;
        $user_externo->nit_rut                   = $request->nit_rut;
        $user_externo->digito_verificacion       = $request->digito_verificacion;
        $user_externo->user()->associate($user);
        $user_externo->save();

        $user_externo->user->assignRole(3);

        return redirect()->route('users.index')->with('success', 'El recurso se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserExterno  $user_externo
     * @return \Illuminate\Http\Response
     */
    public function show(UserExterno $user_externo)
    {
        // $this->authorize('view', [UserExterno::class, $user_externo]);

        return Inertia::render('Users/UsersExternos/Show', [
            'user_externo' => $user_externo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserExterno  $user_externo
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExterno $user_externo)
    {
        $user_externo->user;
        //var_dump($user_externo);
        // $this->authorize('update', [UserExterno::class, $user_externo]);

        return Inertia::render('Users/UsersExternos/Edit', [
            'user_externo' => $user_externo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserExterno  $user_externo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserExternoRequest $request, UserExterno $user_externo)
    {
        // $this->authorize('update', [UserExterno::class, $user_externo]);

        $user_externo->tipo_usuario              = $request->tipo_usuario;
        $user_externo->empresa_centro_formacion  = $request->empresa_centro_formacion;
        $user_externo->nit_rut                   = $request->nit_rut;
        $user_externo->digito_verificacion       = $request->digito_verificacion;

        $user_externo->save();

        $user_externo->user()->update([
            'primer_nombre'                    => $request->primer_nombre,
            'segundo_nombre'                   => $request->segundo_nombre,
            'primer_apellido'                  => $request->primer_apellido,
            'segundo_apellido'                 => $request->segundo_apellido,
            'email'                            => $request->email,
            'tipo_documento'                   => $request->tipo_documento,
            'numero_documento'                 => $request->numero_documento,
            'celular'                          => $request->celular,
            'telefono'                         => $request->telefono,
            'extension'                        => $request->extension,
            'estado'                           => $request->estado,
        ]);

        $user_externo->user->syncRoles(3);

        return redirect()->back()->with('success', 'El recurso se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserExterno  $user_externo
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExterno $user_externo)
    {
        // $this->authorize('delete', [UserExterno::class, $user_externo]);

        // $user_externo->delete();

        // return redirect()->route('users.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
