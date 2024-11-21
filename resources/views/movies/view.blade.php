@extends('layouts.main')

@section('title', $movie->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3" >{{ $movie->title }}</h1>
            <div class="d-flex gap-3 align-items-start">
                <div class="col-3">
                    @if ($movie->cover)
                        <img src="{{ Storage::url($movie->cover) }}"
                        alt="{{ $movie->title }}"
                        class="img-fluid">
                    @else
                        <p>Aqui va la imagen</p>

                    @endif
                </div>
                <dl>
                    <dt>Precio</dt>
                    <dd>{{ $movie->price }}</dd>
                    <dt>Fecha de lanzamiento</dt>
                    <dd>{{ $movie->release_date }}</dd>
                </dl>
            </div>
            <hr class="mb-3">
            <h2 class="mb-3" >Sinopsis</h2>
            <p>{{ $movie->synopsis }}</p>
        </div>
    </div>
</div>

@endsection
