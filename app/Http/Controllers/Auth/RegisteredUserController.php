<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistroExternoRequest;
use App\Models\User;
use App\Models\UserExterno;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Register', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRegistroExternoRequest $request)
    {
        $user = User::create([
            'primer_nombre'                     => $request->primer_nombre,
            'segundo_nombre'                    => $request->segundo_nombre,
            'primer_apellido'                   => $request->primer_apellido,
            'segundo_apellido'                  => $request->segundo_apellido,
            'email'                             => $request->email,
            'password'                          => Hash::make($request->password),
            'tipo_documento'                    => $request->tipo_documento,
            'numero_documento'                  => $request->numero_documento,
            'celular'                           => $request->celular,
            'telefono'                          => $request->telefono,
            'extension'                         => $request->extension,
            'estado'                            => 0,
            'autorizacion_tratamiento_datos'    => $request->autorizacion_tratamiento_datos,
        ]);

        $user_externo = new UserExterno();
        $user_externo->codigo_cliente            = $user_externo::makeCodigo($user->id, $user->created_at);
        $user_externo->tipo_usuario              = $request->tipo_usuario;
        $user_externo->empresa_centro_formacion  = $request->empresa_centro_formacion;
        $user_externo->nit_rut                   = $request->nit_rut;
        $user_externo->digito_verificacion       = $request->digito_verificacion;
        $user_externo->user()->associate($user);
        $user_externo->save();

        $user_externo->user->syncRoles(3);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);
        return redirect()->route('login')->with('success', 'Se ha registrado correctamente. Se ha notificado al administrador del sistema para que habilite su usuario.');
    }

    public function registerInt()
    {
        $usr = User::all();
        return Inertia::render('Auth/RegisterInt', [
            'usr' => $usr,
            'status' => session('status'),
        ]);
    }
}
