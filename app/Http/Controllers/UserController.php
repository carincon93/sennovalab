<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny', [User::class]);

        return Inertia::render('Users/Index', [
            'filters'   => request()->all('search'),
            'users'     => User::orderBy('primer_nombre', 'ASC')
                ->filterUser(request()->only('search'))->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', [User::class]);

        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // $this->authorize('create', [User::class]);

        $user = new User();
        $user->primer_nombre = $request->primer_nombre;
        $user->segundo_nombre = $request->segundo_nombre;
        $user->primer_apellido = $request->primer_apellido;
        $user->segundo_apellido = $request->segundo_apellido;
        $user->email = $request->email;
        $user->password = $user::makePassword($request->numero_documento);
        $user->tipo_documento = $request->tipo_documento;
        $user->numero_documento = $request->numero_documento;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;
        $user->extension = $request->extension;
        $user->autorizacion_datos = $request->autorizacion_datos;

        $user->save();

        return redirect()->route('users.index')->with('success', 'El recurso se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $this->authorize('view', [User::class, $user]);

        return Inertia::render('Users/Show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // $this->authorize('update', [User::class, $user]);

        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        // $this->authorize('update', [User::class, $user]);

        $user->primer_nombre = $request->primer_nombre;
        $user->segundo_nombre = $request->segundo_nombre;
        $user->primer_apellido = $request->primer_apellido;
        $user->segundo_apellido = $request->segundo_apellido;
        $user->email = $request->email;
        $user->tipo_documento = $request->tipo_documento;
        $user->numero_documento = $request->numero_documento;
        $user->celular = $request->celular;
        $user->telefono = $request->telefono;
        $user->extension = $request->extension;

        $user->save();

        return redirect()->back()->with('success', 'El recurso se ha modificado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $this->authorize('delete', [User::class, $user]);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
