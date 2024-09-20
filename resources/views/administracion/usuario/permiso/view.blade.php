<h1>Permiso</h1>

<ul>
    @foreach ($model as $key=>$item)
        <li>({{$key+1}}) {{$item->url}} <span class="badge badge-pill badge-{{$item->switch?"success":"danger"}}">Acceso {{$item->switch?"Permitido":"Negado"}}</span></li>
    @endforeach
</ul>