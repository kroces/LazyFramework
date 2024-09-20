@extends('main_template')

@section('title', "Inicio de sesión")

@section('content')
<h1>Iniciar sesión</h1>

@error('error')
    <div class="alert alert-danger">
        <strong>Error</strong>. Usuario o contraseña incorrecta
    </div>
@enderror

<div class="row">
    <div class="col-md-6">
        <form action="{{route("login")}}" method="post">

            @csrf

            @include('componentes.input',["field"=>"email","label"=>"Correo","type"=>"text", "required"=>false])
        
            @include('componentes.input',["field"=>"password","label"=>"Contraseña","type"=>"password", "required"=>false])

            <input type="submit" value="Iniciar sesión" class="btn btn-success">
        
            <br><br>
            <!--<p>¿Sin cuenta? <a href="#">Click aquí crear una cuenta</a></p>-->
            <!--<p>¿Olvido su contraseña? <a href="{{url('usuario.recuperar')}}">Click aquí para recuperar contraseña</a></p>-->
        </form>
    </div>
</div>
@endsection