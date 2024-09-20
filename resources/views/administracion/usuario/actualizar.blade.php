@extends('main_template')

@section('title',"Editar usuario")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        
        ["url"=>route("administracion.usuario.admin"),"name"=>"Usuarios"],
        ["url"=>route("administracion.usuario.consultar", $model->id),"name"=>$model->name],
        ["url"=>"#","name"=>"Actualizar"],
    ]
])
@endsection

@section('content')
    <h1>Actualizar usuarios</h1>
    
    <form action="{{route("administracion.usuario.actualizar", $model->id)}}" method="post">
        @include('administracion.usuario._form', ["model"=>$model])
    </form>

@endsection