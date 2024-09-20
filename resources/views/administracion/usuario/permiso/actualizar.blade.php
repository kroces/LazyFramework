
@extends('main_template')

@section('title', "Permiso")

@section('head')
    <link rel="stylesheet" href="{{asset(env("PRE_ROUTE").'css/toggleButton.css')}}">
@endsection

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administracion"],
        ["url"=>route("administracion.usuario.admin"),"name"=>"usuarios"],
        ["url"=>route("administracion.usuario.consultar",$model->id),"name"=>$model->email],
        ["url"=>"#","name"=>"permisos"],
    ]
])
@endsection

@section('content')
    <h1>Permisos</h1>

    <label for="">Precargar permisos</label>
    <select name="" id="" onchange="pre_load($(this).val())">
        <option value="">Sin rol</option>
        @foreach ($model->roles() as $rol)
            <option value="{{$rol->id}}">{{$rol->nombre}}</option>
        @endforeach
    </select>

    <form action="{{route('administracion.permiso.actualizar',$model->id)}}" method="post">
        <div id="formulario">
            @include('administracion.usuario.permiso._form', $model)
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{asset(env("PRE_ROUTE").'js/toggleButton.js')}}"></script>
    <script src="{{asset(env("PRE_ROUTE").'js/jQueryForm.js')}}"></script>
    <script>

        function pre_load(id){
            if(id){
                $.get("{{route('administracion.permiso.rol', '__id__')}}".replace('__id__', id), function (data){
                    $("#formulario").html(data);

                    $('input[type="checkbox"]').bootstrapToggle();
                });
            }
        }

    </script>
@endsection