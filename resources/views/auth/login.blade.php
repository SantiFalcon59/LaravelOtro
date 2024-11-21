@extends('layouts.main')

@section('title', 'Ingresa a tu cuenta')

@section('content')

<div class="container">
    <div class="row">
        <h2 class="mb-3">Ingresar a tu cuenta</h2>
        <form action="{{ route('auth.authenticate') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" name="password" id="password" class="form-control">

            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div>
</div>

@endsection
