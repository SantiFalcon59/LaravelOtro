@extends('layouts.main')

@section('title', 'Publicar una nueva pelicula')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Publicar pelicula</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    hay errores en los datos del formularios
                </div>
            @endif
            <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
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
                        value="{{ old('title') }}"
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
                        value="{{ old('price') }}"
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
                        value="{{ old('release_date') }}"
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
                    >{{ old('synopsis') }}</textarea>
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
                                @selected($rating->rating_id == old('rating_fk'))
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
