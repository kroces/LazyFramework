@extends('main_template')

@section('title', "Menú")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administracion"],
    ]
])
@endsection

@section('content')
    @include('administracion._menu')
@endsection