@extends('main_template')

@section('title', "Menú")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
    ]
])
@endsection

@section('content')
    @if (\App\Tools\Router::multiValidate([
        ["reparto.reparto"],
    ]))
    <a href="{{route("reparto.menu")}}">Reparto</a> <br>
    @endif
    @if (\App\Tools\Router::multiValidate([
        ["produccion.fabricado"],
    ]))
    <a href="{{route("produccion.menu")}}">Fabricación</a> <br>
    @endif
    @if (\App\Tools\Router::multiValidate([
        ["almacen.ingresar"],
        ["almacen.reparto.activos"],
        ["almacen.inventario"],
    ]))
        <a href="{{route("almacen.menu")}}">Almacen</a> <br>
    @endif
    @if (\App\Tools\Router::multiValidate([
    ["administracion.producto.admin"],
    ["administracion.ruta.admin"],
    ["administracion.tienda.admin"],
    ["administracion.ayudante.admin"],
    ["administracion.contacto.admin"],
    ["administracion.usuario.admin"],
    ["administracion.rol.admin"],
    ]))
        <a href="{{route("administracion.menu")}}">Administración</a> <br>
    @endif
    @if (\App\Tools\Router::multiValidate([
    ["reporte.tienda"],
    ["reporte.general"],
    ["reporte.repartidor"],
    ]))
        <a href="{{route("reporte.menu")}}">Reportes</a> <br>
    @endif

@endsection