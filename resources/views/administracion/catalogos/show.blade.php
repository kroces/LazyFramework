@extends('main_template')

@section('title', $type)

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>$breadcrumbs
])
@endsection

@section('content')
    <h3 class="title-dark">Consultar de {{$type}}</h3>
    
    @include('componentes.simpleModelDetail',["class"=>"table table_bordered table_hover"])

@endsection