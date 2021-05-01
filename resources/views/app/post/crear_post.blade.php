@extends('layouts.app')


@section('style')
@endsection

@section('content')

<div class="container">
    
    <h1 class="mt-4">Nueva Publicación</h1><br>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
        
        <form method="POST" action="{{ url('/post/nuevo') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Titulo</label>
                <input required="" name="titulo" type="text" class="form-control"  placeholder="Ingrese Titulo">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido</label>
                <textarea required="" name="contenido" class="form-control"  rows="8" placeholder="Escriba el contenido del post."></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
        <div class="col-3"></div>
        </form>
    </div>
</div>


@endsection

@section('scripts')
@endsection