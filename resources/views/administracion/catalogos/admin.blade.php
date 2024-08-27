@extends('main_template')

@section('title', $model->showName())

@section('breadcrumbs')
    @include('componentes.breadcrumbs',["breadcrumbs"=>$breadcrumbs
])
@endsection

@section('content')
    <h3 class="title-dark">Administración de {{$model->showName()}}</h3>
    
    @if (\App\Tools\Router::validate("administracion.".$type.".registrar"))
        <p>
            <a class="btn btn-primary" href="{{route('administracion.'.$type.'.registrar')}}">
                @include('icons.plus') Registrar {{$type}}
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
        "encabezado" => $encabezado,
        "data" => $models,
        "o" => $o,
        "om" => $om,
        "q" => $q,
        "op"=>[
            [
                "icon"=>"icons.eye",
                "text"=> "Ver",
                "class"=>"btn btn-primary",
                "url"=>Route::has('administracion.'.$type.'.consultar')?route('administracion.'.$type.'.consultar', "_model.id"):"",
                "visible"=>\App\Tools\Router::validate("administracion.".$type.".consultar"),
            ],
            [
                "icon"=>"icons.pencil",
                "text"=> "Modificar",
                "class"=>"btn btn-warning",
                "url"=>Route::has('administracion.'.$type.'.actualizar')?route('administracion.'.$type.'.actualizar', "_model.id"):"",
                "visible"=>\App\Tools\Router::validate("administracion.".$type.".actualizar"),
            ],
            [
                "icon"=>"icons.trash",
                "text"=> "Borrar",  
                "class"=>"btn btn-danger",
                "url"=>Route::has("administracion.".$type.".borrar")?route("administracion.".$type.".borrar", "_model.id"):"",
                "div"=>true,
                "onclick"=>"confirmModal('¿Borrar dato?',$(this).attr('href'))",
                "visible"=>\App\Tools\Router::validate("administracion.".$type.".borrar"),
            ]
        ]
    ])

@endsection

@section('modals')
    @include('componentes.confirm')
@endsection