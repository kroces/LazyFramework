@extends('main_template')

@section('title', $type)

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>$breadcrumbs
])
@endsection

@section('content')
    <h3 class="title-dark">Registro de {{$type}}</h3>
    
    @include('componentes.form', ["action"=>route("administracion.".$type.".".$action), "method"=>'post','inputs'=>$inputs])

@endsection