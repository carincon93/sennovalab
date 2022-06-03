<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AppController extends Controller
{
    public function usersIndex()
    {
        return Inertia::render('Users/Index', [
            'filters'   => request()->all('search'),
            'users'     => User::with('userInterno', 'userExterno')->orderBy('primer_nombre', 'ASC')
                ->filterUser(request()->only('search'))->paginate(),
        ]);
    }

    public function destroyUser(User $user)
    {
        // $this->authorize('delete', [User::class, $user]);

        if ($user->userInterno()->exists()) {
            Storage::delete($user->userInterno->firma_digital);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'El recurso se ha eliminado correctamente.');
    }
}
