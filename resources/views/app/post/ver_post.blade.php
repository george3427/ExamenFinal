@extends('layouts.app')


@section('style')
@endsection

@section('content')
   <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            
            <div style="margin-top:20px;" class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button onclick="window.print();" class="btn btn-primary" type="button"><i class="fas fa-user fa-print"></i></button>
            </div>
            <div class="mb-3">
                <h1 class="mt-4">{{ $post->titulo }}</h1><br>
            </div>
            <div class="mb-3">
                <p style="text-align: justify;font-size: 18px;font-style: italic;"> {{ $post->contenido }} </p>
            </div>
            <hr>
            <div class="mb-3">
                <p class="text-muted text-right"> Author : {{ $username }} - {{ $post->created_at }} </p>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
@endsection

@section('scripts')
@endsection