@extends('main_template')

@section('title',"rol")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        ["url"=>route("administracion.rol.admin"),"name"=>"rols"],
        ["url"=>route("administracion.rol.registrar"),"name"=>"consulta"],
    ]
])
@endsection

@section('content')

    <h1>Permiso: {{$model->nombre}}</h1>

    @if (\App\Tools\Router::validate("administracion.rol.actualizar"))
        <p><a href="{{route("administracion.rol.actualizar", $model->id)}}" class="btn btn-success">Editar rol</a></p>
    @endif
    
    @foreach (json_decode($model->permisos) as $key => $item)
        <li>({{$key+1}}) {{$item->url}} <span class="badge badge-pill badge-{{$item->switch?"success":"danger"}}">Acceso {{$item->switch?"Permitido":"Negado"}}</span></li>
    @endforeach

@endsection