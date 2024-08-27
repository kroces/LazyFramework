@extends('main_template')

@section('title', "Menú")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
    ]
])
@endsection

@section('content')
    <h1>Ejemplo del LazyFramework</h1>
@endsection