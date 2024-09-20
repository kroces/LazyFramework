<!doctype html>
<html lang="en">
    <head>
        <title>@yield('title',"TITULO")</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/x-icon" href="{{asset(env("PRE_ROUTE")."spartan.png?v=1.0")}}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset(env("PRE_ROUTE").'css/main.css?v=1.0')}}">
        @yield("head")

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="page-container">
            <div class="wrapper">
                <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #da0909;">
                    <div class="container">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            LazyFramework
                        </a>
                        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                            @include('icons.list')
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavId">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('administracion.ejemplo.admin')}}">Demo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('administracion.ejemploRelacion.admin')}}">Demo 2</a>
                                </li>
                                @auth
                                    @if (\App\Tools\Router::multiValidate([
                                        ["administracion.usuario.admin"],
                                        ["administracion.rol.admin"],
                                    ]))
                                        <li class="nav-item dropdown {{ request()->routeIs('administracion.*')?"active":"" }}">
                                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administración</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                                @include('administracion._menu')
                                            </div>
                                        </li>
                                    @endif
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->email}}</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                                            <form method="POST" action="{{route('logout')}}" id="logout">@csrf</form>
                                            <a class="dropdown-item" href="#" onclick="$('#logout').submit()">Cerrar sesión</a>
                                        </div>
                                    </li>
                                @endauth
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('login')}}">Iniciar sesión</a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
                
                <div class="container mt-2">
                    @yield('breadcrumbs')
                </div>

                <div class="@yield('container','container') mb-5">
                    @yield('alert')
                    @yield('content')
                </div>
            </div>

            <footer class="footer-container d-print-none">
                
            </footer>
        </div>

        <div class="toast flash" data-autohide="false">
            <div class="toast-header" id="flash-header">
                @include('icons.bell')
                <strong class="mr-auto" id="flash-title">Placeholder</strong>
                <small class="flash-time"></small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body" id="flash-msg">
                Placeholder message
            </div>
        </div>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        @auth
            <script>
                function flash(title, msg, color="bg-info", time = 5){
                    $("#flash-title").html(title);
                    $("#flash-msg").html(msg);
                    $("#flash-time").html();
                    $("#flash-header").attr("class","toast-header "+color);
                    $('.toast').toast('show');
                }
            </script>

            @if (auth()->user()->cliente_proveedor_id)
                <script>

                    $("#carrito").html({{auth()->user()->carrito()->total()}});

                    function carrito(id, cantidad, update = false){
                        data = {
                            "_token":"{{ csrf_token() }}",
                            "id":id,
                            "cantidad":cantidad
                        };
                        $.post("{{route('tienda.carrito.agregar')}}", data, function (respuesta){
                            if(respuesta.status){
                                flash("¡¡ÉXITO!!","Agregado al carrito", "alert-success");
                                $("#carrito").html(respuesta.total);
                            }
                            else
                                flash("Fallo operación", "alert-danger");
                            if(update){
                                setTimeout(() => {
                                    window.location.reload();
                                }, 500);
                            }
                        });
                    }
                </script>
            @endif
        @endauth

        @yield("modals")
        @yield("scripts")

    </body>
</html>