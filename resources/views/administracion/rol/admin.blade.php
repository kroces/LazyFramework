@extends('main_template')

@section('title',"rol")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
        ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        ["url"=>route("administracion.rol.admin"),"name"=>"rols"],
    ]
])
@endsection

@section('content')
    <h3 class="title-dark">Administración de rols</h3>

    @if (\App\Tools\Router::validate("administracion.rol.registrar"))
        <p>
            <a class="btn btn-primary" href="{{route('administracion.rol.registrar')}}">
                @include('icons.plus') Registrar rol
            </a>
        </p>
    @endif

    <form action="">
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="q" id="" value="{{$q}}">
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

    @include("componentes.tabla",[
        "clases" => "table table-striped table-bordered",
        "encabezado" => [ 
            ["campo"=>"nombre", "nombre"=>"Nombre"],
        ],
        "data" => $models,
        "o" => $o,
        "om" => $om,
        "q" => $q,
        "op"=>[
            [
                "icon"=>"icons.eye",
                "text"=> "Ver",
                "class"=>"btn btn-primary",
                "url"=>route('administracion.rol.consultar', "_model.id"),
                "visible"=>\App\Tools\Router::validate("administracion.rol.consultar"),
            ],
            [
                "icon"=>"icons.pencil",
                "text"=> "Modificar",
                "class"=>"btn btn-warning",
                "url"=>route('administracion.rol.actualizar', "_model.id"),
                "visible"=>\App\Tools\Router::validate("administracion.rol.actualizar"),
            ],
            [
                "icon"=>"icons.trash",
                "text"=> "Borrar",
                "class"=>"btn btn-danger",
                "onclick"=>"confirmModal('¿Borrar dato?',$(this).attr('href'))",
                "div"=>true,
                "url"=>route("administracion.rol.borrar", "_model.id"),
                "visible"=>\App\Tools\Router::validate("administracion.rol.borrar"),
            ]
        ]
    ])

@endsection
@section('modals')
    @include('componentes.confirm')
@endsection