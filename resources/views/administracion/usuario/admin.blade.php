@extends('main_template')

@section('title',"Usuarios")

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>[
                ["url"=>"/","name"=>"Inicio"],
        ["url"=>route("menu"),"name"=>"Menú"],
        ["url"=>route("administracion.menu"),"name"=>"administración"],
        
        ["url"=>route("administracion.usuario.admin"),"name"=>"Usuarios"],
    ]
])
@endsection

@section('content')
    <h1>Usuarios</h1>

    @if (\App\Tools\Router::validate("administracion.usuario.registrar"))
        <a href="{{route("administracion.usuario.registrar")}}" class="btn btn-success">
            @include('icons.plus')
            Registrar usuario
        </a>
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
            ["campo"=>"email", "nombre"=>"Nombre de usuario"]
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
                "url"=>route('administracion.usuario.consultar', "_model.id"),
                "visible"=>\App\Tools\Router::validate("administracion.usuario.consultar"),
            ],
            [
                "icon"=>"icons.pencil",
                "text"=> "Modificar",
                "class"=>"btn btn-warning",
                "url"=>route('administracion.usuario.actualizar', "_model.id"),
                "visible"=>\App\Tools\Router::validate("administracion.usuario.actualizar"),
            ],
            [
                "icon"=>"icons.trash",
                "text"=> "Borrar",  
                "class"=>"btn btn-danger",
                "div"=>true,
                "onclick"=>"confirmModal('¿Borrar dato?',$(this).attr('href'))",
                "url"=>route("administracion.usuario.borrar", "_model.id"),
                "visible"=>\App\Tools\Router::validate("administracion.usuario.borrar"),
            ]
        ]
    ])
    
@endsection

@section('modal')
    @include('componentes.confirm')
@endsection