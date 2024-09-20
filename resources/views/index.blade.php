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


    <table class="table table-bordered table-hover table-stripped">
        <tr><th>Lazy Model</th></tr>
        <tr>
            <td>
                TODO...
            </td>
        </tr>
        <tr><th>Lazy Controller</th></tr>
        <tr>
            <td>
                TODO...
            </td>
        </tr>
        <tr><th>Breadcrumbs</th></tr>
        <tr>
            <td>
                TODO...
            </td>
        </tr>
        <tr><th>Dynamic Permissions</th></tr>
        <tr>
            <td>
                TODO...
            </td>
        </tr>
    </table>

@endsection