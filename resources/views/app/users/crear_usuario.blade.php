@extends('layouts.app')


@section('style')
@endsection

@section('content')

<div class="container">
    
    <h1 class="mt-4">Nuevo Usuario</h1><br>
    @if ($errors->any())
        <div class="alert alert-danger">{{$errors->first()}}</div>
    @endif
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
        
        <form method="POST" action="{{ url('/users/nuevo') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input required="" name="name" type="text" class="form-control"  placeholder="Ingrese Nombre">
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input required="" name="email" type="text" class="form-control"  placeholder="Ingrese Correo">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input required="" name="password" type="password" class="form-control"  placeholder="Ingrese Contraseña">
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <select name="rol" class="form-control" aria-label="Default select example">\
                    <option selected="" value="usuario">Usuario</option>
                    <option value="editor">Editor</option>
                    <option value="admin">Admin</option>
                </select>
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