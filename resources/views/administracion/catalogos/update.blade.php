@extends('main_template')

@section('title', $type)

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>$breadcrumbs
])
@endsection

@section('content')
    <h3 class="title-dark">Actualizar {{$type}}</h3>
    
    @include('componentes.form', ["action"=>route("administracion.".$type.".".$action, $model->id), "method"=>'post','inputs'=>$inputs])

@endsection