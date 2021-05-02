@extends('layouts.app')


@section('style')
@endsection

@section('content')

<div class="container-fluid">
    <h1 class="mt-4">Wiki de Ayuda</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Wiki De Ayuda</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Universidad Latina de Heredia.<br>
            Examen Final <br>
        </div>
        
    </div>
    <div class="alert alert-info text-center" role="alert">
        {{ $posts }} Publicaciones registradas en la Wiki.
    </div>
</div>



@endsection

@section('scripts')
@endsection
