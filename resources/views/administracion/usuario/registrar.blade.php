@extends('main_template')

@section('title',"Usuario")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
                ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        
        ["url"=>route("administracion.usuario.admin"),"name"=>"Usuarios"],
        ["url"=>"#","name"=>"Registro"],
    ]
])
@endsection

@section('content')
    <h1>Registrar usuario</h1>
    
    <form action="{{route("administracion.usuario.registrar", $model->contacto_id)}}" method="post">
        @include('administracion.usuario._form', ["model"=>$model])
    </form>

@endsection