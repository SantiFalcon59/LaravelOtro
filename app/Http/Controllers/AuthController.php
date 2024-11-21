<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        //TODO validar...
         /*
        # Autenticación
        Para acceder al sistema de autenticación de Laravel, tenemos que obtener
        la clase de autenticación. Hay 3 formas en que podemos obtenerla:
            - auth()
            - \Auth
            - \Illuminate\Support\Facades\Auth

        Pueden usar la que más les guste.
        Dentro de esa clase, vamos a tener varios métodos para manejar la autenticación.
        Entre ellos, está "attempt()".
        Este método "intenta" autenticar a un usuario a través de las credenciales que
        le pasamos como argumento.
        Si tiene éxito, autentica al usuario y retorna true.
        Sino, retorna false.

        Las credenciales para el attempt deben ser un array que contenga al menos 2
        claves:
        - Una clave para el password, que por defecto debe llamarse "password".
        - Una o más claves para buscar al registro del usuario en la base de datos.
        */
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            return redirect()
                ->intended(route('movies.index'))
                ->with('feedback.message', 'Sesion iniciada con exito!');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('feedback.message', 'las credenciales tiene problemas!');
    }

    public function logout(Request $request)
    {
        //cerrar la sesion
        auth()->logout();

        //invalidamos la sesion, creamos otra y regeneramos el token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login')
            ->with('feedback.message', 'sesion cerrada con exito, volve pronto!');
    }

}
