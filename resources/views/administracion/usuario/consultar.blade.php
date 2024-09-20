@extends('main_template')

@section('title',"Usuario Detalle")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        
        ["url"=>route("administracion.usuario.admin"),"name"=>"Usuarios"],
        ["url"=>route("administracion.usuario.consultar", $model->id),"name"=>$model->email],
    ]
])
@endsection

@section('content')

    @if (\App\Tools\Router::validate("administracion.usuario.actualizar"))
        <p><a href="{{route("administracion.usuario.actualizar", $model->id)}}" class="btn btn-success">Editar Usuario</a></p>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nombre de usuario:</th>
            <td>{{$model->email}}</td>
        </tr>
        <tr>
            <th>Fecha de registro:</th>
            <td>{{$model->created_at}}</td>
        </tr>
        <tr>
            <th>Última actualización:</th>
            <td>{{$model->updated_at}}</td>
        </tr>
    </table>
    @if (\App\Tools\Router::validate("administracion.permiso.actualizar"))
        <a href="{{route('administracion.permiso.actualizar', $model->id)}}" class="btn btn-warning">Editar permisos</a>
    @endif
@endsection