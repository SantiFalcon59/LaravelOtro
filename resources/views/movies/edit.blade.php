@extends('layouts.main')

@section('title', 'Editar la pelicula '.e($movie->title))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Editar pelicula {{ $movie->title }}</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    hay errores en los datos del formularios
                </div>
            @endif
            <form action="{{ route('movies.update', ['id' => $movie->movie_id]) }}" method="POST" enctype="multipart/form-data">
                {{--
                    @method('PUT') es una directiva de Blade que renderiza un campo oculto
                    con el valor PUT. Esto es necesario porque los formularios HTML
                    solo soportan los métodos GET y POST, pero Laravel soporta PUT y DELETE
                    a través de un campo oculto llamado _method.
                --}}
                @method('PUT')
                {{--
                    @csrf es una directiva de Blade que renderiza un campo oculto con el
                    token CSRF. Esto es necesario para proteger la aplicación de ataques
                    de tipo CSRF.
                --}}
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    {{--
                        old() es una función de Laravel que retorna el valor "viejo" que tenía un campo
                        de la petición luego de un error de validación.
                        Puede llevar un segundo parámetro con un valor por defecto.
                    --}}
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $movie->title) }}"
                    >
                    {{--
                        @error(campo) pregunta si existe un error para ese campo, y de existir,
                        renderiza su contenido. Entre el @error y el @enderror va a existir una
                        variable $message con el mensaje de error.
                    --}}
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>

                    <input
                        type="text"
                        id="price"
                        name="price"
                        class="form-control"
                        value="{{ old('price', $movie->price) }}"
                    >
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="release_date" class="form-label">Fecha de Lanzamiento</label>

                    <input
                        type="date"
                        id="release_date"
                        name="release_date"
                        class="form-control"
                        value="{{ old('release_date', $movie->release_date) }}"
                    >
                    @error('release_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea
                        name="synopsis"
                        id="synopsis"
                        class="form-control"
                    >{{ old('synopsis', $movie->synopsis) }}</textarea>
                    @error('synopsis')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="rating_fk" class="form-label">Clasificacion</label>
                    <select
                        name="rating_fk"
                        id="rating_fk"
                        class="form-control"
                    >
                        @foreach ($ratings as $rating)
                            <option
                                value="{{ $rating->rating_id }}"
                                {{-- @if($rating->rating_id == old('rating_fk')) selected @endif --}}
                                @selected($rating->rating_id == old('rating_fk', $movie->rating_fk))
                            >
                                {{ $rating->name }} ({{ $rating->abbreviation }})
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label"></label>
                    <input name="cover" id="cover" class="form-control" type="file">
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
</div>

@endsection
