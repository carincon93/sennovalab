<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInterno;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserInternoRequest;
use App\Http\Requests\UpdateUserInternoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserInternoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny', [User::class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', [User::class]);

        return Inertia::render('Users/UsersInternos/Create', [
            'roles_sennovalab'  => Role::select('id as value', 'name as label')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserInternoRequest $request)
    {
        // $this->authorize('create', [User::class]);

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

        $user_interno = new UserInterno();
        $user_interno->codigo_usuario                = $user_interno::makeCodigo($user->id, $user->created_at);
        $user_interno->tipo_afiliacion               = $request->tipo_afiliacion;
        $user_interno->numero_contrato               = $request->numero_contrato;
        $user_interno->fecha_inicio_contrato         = $request->fecha_inicio_contrato;
        $user_interno->fecha_finalizacion_contrato   = $request->fecha_finalizacion_contrato;
        $user_interno->firma_digital                 = $request->firma_digital->store('firmas-digitales');
        $user_interno->user()->associate($user);
        $user_interno->save();

        $user_interno->user->assignRole($request->rol_id);

        return redirect()->route('users.index')->with('success', 'El recurso se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(UserInterno $user_interno)
    {
        // $this->authorize('view', [User::class, $user]);

        $user_interno->user;

        return Inertia::render('Users/UsersInternos/Show', [
            'user_interno' => $user_interno
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInterno $user_interno)
    {
        // $this->authorize('update', [User::class, $user_interno]);

        $user_interno->user;
        //var_dump($user_interno->user);
        //$user_interno->user->rol_id = $user_interno->user->roles()->first() ? $user_interno->user->roles()->first()->id : null;

        return Inertia::render('Users/UsersInternos/Edit', [
            'user_interno'      => $user_interno,
            'roles_sennovalab'  => Role::select('id as value', 'name as label')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserInternoRequest $request, UserInterno $user_interno)
    {
        // $this->authorize('update', [User::class, $user_interno]);

        $user_interno->tipo_afiliacion               = $request->tipo_afiliacion;
        $user_interno->numero_contrato               = $request->numero_contrato;
        $user_interno->fecha_inicio_contrato         = $request->fecha_inicio_contrato;
        $user_interno->fecha_finalizacion_contrato   = $request->fecha_finalizacion_contrato;

        if ($request->hasFile('firma_digital')) {
            Storage::delete($user_interno->firma_digital);
            $user_interno->firma_digital = $request->firma_digital->store('firmas-digitales');
        }
        $user_interno->save();

        $user_interno->user()->update(
            [
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
            ]
        );

        $user_interno->user->syncRoles($request->rol_id);

        return redirect()->back()->with('success', 'El recurso se ha actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInterno $user_interno)
    {
        // $this->authorize('delete', [User::class, $user_interno]);

        // $user_interno->delete();

        // return redirect()->route('users.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
