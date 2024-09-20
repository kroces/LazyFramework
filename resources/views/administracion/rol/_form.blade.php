@csrf

@include('componentes.errors')

@include('componentes.input', ["label"=>"Nombre", "required"=>"true", "field"=>"nombre", "type"=>"text", "value"=>$model])

@include('administracion.usuario.permiso._form')

