<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $allMovies = Movie::with(['rating'])->get();

        return view('movies.index',[
            'movies' => $allMovies
        ]);
    }

    public function show($id)
    {
        return view('movies.view', [
            'movie' => Movie::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('movies.create', [
            'ratings' => Rating::all()
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|min:2',
            'price' => 'required|numeric',
            'release_date' => 'required'
        ],[
            'title.required' => 'el titulo debe tener un valor',
            'title.min' => 'el titulo detener al menos :min caracteres'
        ]);

        $input = $request->all();

        if($request->hasFile('cover')){
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $movie = Movie::create($input);

        // Redireccionamos al listado.
        // Vamos a agregar un mensaje de feedback para informarle al usuario que la acción tuvo
        // éxito.
        // Típicamente, esto lo logramos usando una variable de sesión que contenga el mensaje
        // en cuestión, para que el próximo renderizado de la web pueda imprimirlo.
        // Además, solemos esperar que ese mensaje solo se muestre una única vez. Es decir,
        // una vez que imprimimos el mensaje, la variable de sesión debería limpiarse.
        // Esto se suele llamar "flashear" un valor en la sesión.
        // Los redireccionamentos de Laravel permiten llamar a un método with() para flashear
        // valores en la sesión.

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'la pelicula '.e($movie->title).' se publico con exito');
    }

    public function edit($id)
    {
        return view('movies.edit', [
            'movie' => Movie::findOrFail($id),
            'ratings' => Rating::all()
        ]);
    }

    public function update(int $id, Request $request)
    {
        $movie = Movie::findOrFail($id);
        $input = $request->except(['_token', '_method']);
        $oldCover = $movie->cover;

        $request->validate([
            'title' => 'required|min:2',
            'price' => 'required|numeric',
            'release_date' => 'required'
        ],[
            'title.required' => 'el titulo debe tener un valor',
            'title.min' => 'el titulo detener al menos :min caracteres'
        ]);

        if($request->hasFile('cover')){
            $input['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $movie->update($input);

        if($request->hasFile('cover') && $movie->cover){
            Storage::delete($oldCover);
        }

        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'la pelicula '.e($movie->title).' se actualizo con exito');
    }

    public function destroy(int $id)
    {
        $movie = Movie::findOrFail($id);

        $movie->delete();

        if($movie->cover){
            Storage::delete($movie->cover);
        }


        return redirect()
            ->route('movies.index')
            ->with('feedback.message', 'la pelicula '.e($movie->title).' se elimino con exito');
    }
}
