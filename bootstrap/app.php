<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Configuramos la URL a donde queremos que Laravel redireccione a los
        // usuarios no autenticados que tratan de ingresar a una ruta que
        // requiera autenticación.
        // $middleware->redirectGuestsTo('/iniciar-sesion');

        // Arriba usamos la URL para indicar a donde redireccionar.
        // Pero en el proyecto estamos usando los nombres de las rutas, no
        // las URLs. Esto es más práctico. Así que vamos a probar de ponerle
        // la ruta al redireccionamiento.
        // $middleware->redirectGuestsTo(route('auth.login.form'));

        // El código de recién no funciona. ¿Por qué? Porque route()
        // requiere que la aplicación esté creada y corriendo para
        // funcionar.
        // Acá, como podemos ver, estamos en un método *anterior* al
        // create(). Es decir, no está la aplicación. Por ende, hay
        // múltiples cosas que no funcionan.
        // Por ejemplo, vamos a ver que no cargó el módulo de la
        // pantalla linda de errores.
        // ¿Cómo lo solucionamos?
        // La documentación nos muestra que podemos usar un callback
        // para resolverlo.
        // $middleware->redirectGuestsTo(fn() => route('auth.login'));

        $middleware->redirectGuestsTo(function(Request $request){
            session()->flash('feedback.message', 'Necesita iniciar sesion para acceder');
            return route('auth.login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
