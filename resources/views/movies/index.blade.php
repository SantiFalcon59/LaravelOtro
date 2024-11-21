@extends('layouts.main')

@section('title', 'Peliculas')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Listado de peliculas</h2>
            @auth
                <div class="mb-3">
                    <a  href="{{ route('movies.create') }}"
                        class="btn btn-primary"
                    >Publicar una nueva pelicula</a>
                </div>
            @endauth
            <table class="table table-borderes table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Precio</th>
                        <th>Fecha de Estreno</th>
                        <th>Clasificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->movie_id }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->price }}</td>
                        <td>{{ $movie->release_date }}</td>
                        <td>{{ $movie->rating->name }}</td>
                        <td>
                            <a  href="{{ route('movies.show', ['id' => $movie->movie_id]) }}"
                                class="btn btn-primary"
                            >
                                Ver
                            </a>
                            @auth
                                <a  href="{{ route('movies.edit', ['id' => $movie->movie_id]) }}"
                                    class="btn btn-secondary ms-2"
                                >
                                    Editar
                                </a>
                                <form   action="{{ route('movies.destroy', ['id' => $movie->movie_id]) }}"
                                        method="POST"
                                    >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger ms-2"
                                            onclick="return confirm('¿Estas seguro de eliminar esta pelicula?')"
                                    >
                                        Eliminar
                                    </button>
                                </form>

                            @endauth
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
