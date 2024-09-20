@if (\App\Tools\Router::validate("administracion.rol.admin"))
    <a class="dropdown-item" href="{{route("administracion.rol.admin")}}">Rol</a>
@endif
@if (\App\Tools\Router::validate("administracion.usuario.admin"))
    <a class="dropdown-item" href="{{route("administracion.usuario.admin")}}">Usuario</a>
@endif
