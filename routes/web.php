<?php

use Illuminate\Support\Facades\Route;

/*
Las rutas definen los "endpoints" de nuestra aplicación.
Es decir, los puntos de acceso que los usuarios pueden
visitar.

Para que una URL dentro de nuestro sitio exista, debe
tener una ruta que la defina.

Cada ruta se compone de dos partes:
- Combinación de método HTTP y de URL.
- Acción a realizar.

El método HTTP define, justamente, con qué método
se acepta que se ingrese a ese endpoint.
Pueden ser: get, post, put, patch, delete, options. Se
indica el que queremos usar con el método del mismo
nombre de la clase Route. Por ejemplo: Route::get(),
Route::post(), etc.

La URL es la URL a partir de la carpeta pública raíz del
sitio (por defecto, [public]).

La acción es el código que queremos ejecutar cuando se
ingresa a la combinación de método HTTP y URL.
Esto puede ser una función anónima (Closure), o más
comúnmente, un método de un Controller.
Es habitual que estas acciones retornen una Response.

La función view(), por ejemplo, genera una Response a
partir de un template de HTML, que llamamos una "vista".
Las vistas existen en la carpeta [resources/views].
Qué vista es la que queremos mostrar lo indicamos como
argumento de la función. Pasamos el nombre del archivo
de la vista sin extensión (ni [.blade.php] ni [.php]),
y opcionalmente reemplazando "/" por ".".
*/

// Versión con Closure.
// Route::get('/', function () {
//     return view('welcome');
// });

// Versión con Controller.
// Para hacerlo, podemos pasar un array de dos posiciones:
// 1. String. El nombre completo (FQN - Fully-Qualified Name) de la clase.
// 2. String. El nombre del método de esa clase que hay que ejecutar.
// Route::get('/', ["\\App\\Http\\Controllers\\HomeController", "home"]);

Route::get('/', [App\Http\Controllers\HomeController::class, "home"])
    ->name('index');

Route::get('contacto', [App\Http\Controllers\HomeController::class, "contact"])
    ->name('contact');

Route::get('peliculas/listado', [App\Http\Controllers\MovieController::class, "index"])
    ->name('movies.index');

Route::get('peliculas/{id}', [App\Http\Controllers\MovieController::class, "show"])
    ->name('movies.show')
    ->whereNumber('id');

Route::get('peliculas/publicar', [App\Http\Controllers\MovieController::class, "create"])
    ->name('movies.create');

Route::post('peliculas/publicar', [App\Http\Controllers\MovieController::class, "store"])
    ->name('movies.store')
    ->middleware('auth');

Route::get('peliculas/{id}/editar', [App\Http\Controllers\MovieController::class, "edit"])
    ->name('movies.edit')
    ->whereNumber('id')
    ->middleware('auth');

Route::put('peliculas/{id}/editar', [App\Http\Controllers\MovieController::class, "update"])
    ->name('movies.update')
    ->whereNumber('id')
    ->middleware('auth');

Route::delete('peliculas/{id}/elimar', [App\Http\Controllers\MovieController::class, "destroy"])
    ->name('movies.destroy')
    ->whereNumber('id')
    ->middleware('auth');

Route::get('iniciar-sesion', [App\Http\Controllers\AuthController::class, 'login'])
    ->name('auth.login');
Route::post('iniciar-sesion', [App\Http\Controllers\AuthController::class, 'authenticate'])
    ->name('auth.authenticate');
Route::post('cerrar-sesion', [App\Http\Controllers\AuthController::class, 'logout'])
    ->name('auth.logout');

