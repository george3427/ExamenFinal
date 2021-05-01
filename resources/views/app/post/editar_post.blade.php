@extends('layouts.app')


@section('style')
@endsection

@section('content')

<div class="container">
    
    <h1 class="mt-4">Modificar Publicación</h1><br>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
        
        <form method="POST" action="{{ url('/post/editar/'.$post->id) }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Titulo</label>
                <input value="{{ $post->titulo }}" required="" name="titulo" type="text" class="form-control"  placeholder="Ingrese Titulo">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Contenido</label>
                <textarea required="" name="contenido" class="form-control"  rows="8" placeholder="Escriba el contenido del post.">{{ $post->contenido }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Modificar</button>
        </div>
        <div class="col-3"></div>
        </form>
    </div>
</div>


@endsection

@section('scripts')
@endsection