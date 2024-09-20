@extends('main_template')

@section('title',"rol")

@section('head')
    <link rel="stylesheet" href="{{asset(env("PRE_ROUTE").'css/toggleButton.css')}}">
@endsection

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        ["url"=>route("administracion.rol.admin"),"name"=>"rols"],
        ["url"=>route("administracion.rol.registrar"),"name"=>"registro"],
    ]
])
@endsection

@section('content')
    <h1>Permisos</h1>

    <form action="{{route('administracion.rol.registrar')}}" method="post">
        @include('administracion.rol._form', $model)
    </form>

@endsection

@section('scripts')
    <script src="{{asset(env("PRE_ROUTE").'js/toggleButton.js')}}"></script>
    <script src="{{asset(env("PRE_ROUTE").'js/jQueryForm.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection